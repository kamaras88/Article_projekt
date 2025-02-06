<?php

session_start();

$connection = mysqli_connect('localhost', 'root', '', 'peter');

if ($err = mysqli_connect_error()) {
    exit($err);
}

if (!isset($_SESSION["authuserId"])) {
    exit('Jelenleg nem vagy belépve!<a href = "login.php">Tovább a belépés oldalra</a>');
} else {
    $sql = mysqli_query($connection, "SELECT * FROM users WHERE id = {$_SESSION["authuserId"]}");
    $user = mysqli_fetch_assoc($sql);
}

include("includes/message.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        body {
            background-image: url('news.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
        }

        .table-container {
            width: 80%;
            margin: 20px auto;
        }

        
.forms-container {
  background-color: #f5f0e1;
  padding: 20px;
  border-radius: 10px; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
  margin-top: 20px; 
}


.forms-container form {
  margin-bottom: 20px; 
}

.forms-container label {
  font-weight: bold; 
  margin-bottom: 5px;
}

.forms-container input[type="text"],
.forms-container input[type="number"],
.forms-container textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.forms-container button {
  background-color: #4CAF50; 
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.forms-container button:hover {
  background-color: #45a049; 
}
       
    </style>

</head>

<body>

    <div class="container-fluid">
       <a class="navbar-brand" href="Profile.php">Profil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="Articles.php">Adatbázis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="logout.php">Kijelentkezés</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>



    <div class="table-container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>author</th>
                    <th>content</th>
                    <th>link</th>
                </tr>
                <tr>
                    <td colspan="4"><input type="text" id="search" placeholder="Keresés..."></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($connection, "SELECT id, author, content, link FROM article");

                if ($sql) {
                    while ($data = mysqli_fetch_assoc($sql)) {
                        print "<tr class='article-row'>";
                        print "<td>" . $data["id"] . "</td>";
                        print "<td>" . $data["author"] . "</td>";
                        print "<td>" . $data["content"] . "</td>";
                        print "<td>" . $data["link"] . "</td>";
                        print "</tr>";
                    }
                } else {
                    echo "Hiba a lekérdezés során: " . mysqli_error($connection);
                }
                ?>
            </tbody>
        </table>
    </div>



    <?php if ($user["role"] === "admin") : ?>
        <div class="forms-container">
    <h3>Cikk törlése</h3>
    <form action="articles_process.php" method="post">
        <label for="DeleteId">Törölni kívánt cikk sorszáma:</label>
        <input type="number" name="DeleteId" id="DeleteId" required>
        <button type="submit" class="btn btn-danger">Cikk törlése</button>
    </form>

    <h3>Cikk hozzáadása</h3>
    <form action="articles_process.php" method="post" class="row g-3">
        <div class="col-md-2">
            <label for="Addtitle" class="form-label">Cím:</label>
            <input type="text" name="Addtitle" id="Addtitle" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="Addauthor" class="form-label">Szerző:</label>
            <input type="text" name="Addauthor" id="Addauthor" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="Addcontent" class="form-label">Tartalom:</label>
            <textarea name="Addcontent" id="Addcontent" rows="2" class="form-control" required></textarea>
        </div>
        <div class="col-md-2">
            <label for="Addlink" class="form-label">Link:</label>
            <input type="text" name="Addlink" id="Addlink" class="form-control">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Cikk hozzáadása</button>
        </div>
    </form>
</div>
<?php endif ?>

    <script>
        const searchInput = document.getElementById('search');
        const articleRows = document.querySelectorAll('.article-row');

        searchInput.addEventListener('keyup', function (event) {
            const searchTerm = event.target.value.toLowerCase();

            articleRows.forEach(row => {
                let rowText = "";
                for (const cell of row.cells) {
                    rowText += cell.textContent.toLowerCase() + " ";
                }


                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        
    document.querySelector('[href="logout.php"]').onclick = function (e){
    let eredmeny = confirm('Biztosan ki szeretnél lépni?')
    if (!eredmeny)
    e.preventDefault();

}



</script>
</body>

</html>

<?php
unset($_SESSION["post"]); ?>