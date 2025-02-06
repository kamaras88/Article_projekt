<?php
//appworld-hu --> appworld
//Admin --> kamaras
//Testuser --> user1

session_start();


?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div style="margin-top:40px;"> 
    <h1><i>Article project</i></h1>
    <h2><i>Belépés</i></h2>



    <form action="login_process.php" method="post">
        <label for="name">Adja meg a nevét!</label>
        <br>
        <input type="text" name="name" id="name" value="<?php print $_SESSION["post"]["name"] ?? '' ?>">
        <br><br>

        <label for="password">Adja meg a jelszavát!</label>
        <br>
        <input type="password" name="password" id="password">
        <br><br>

        <button type="submit" class="btn btn-outline-success">Belépés</button>
        <br><br>
        <?php 
        include("includes/message.php");
        ?>
    
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_SESSION["post"]))
    unset($_SESSION["post"]);
?>