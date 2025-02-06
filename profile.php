Profile.php



<?php



session_start();



$connection = mysqli_connect('localhost', 'root', '', 'peter');



if ($err = mysqli_connect_error()) {

exit($err);

}



if (!isset($_SESSION["authuserId"])){



exit('Jelenleg nem vagy belépve!<a href = "login.php">Tovább a belépés oldalra</a>');

} else {

$sql = mysqli_query($connection, "SELECT * FROM users WHERE id = {$_SESSION["authuserId"]}");

$user = mysqli_fetch_assoc($sql);

}







?>



<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Document</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="style.css" rel="stylesheet">

</head>

<body>





<div class="container-fluid">

<a class="navbar-brand" href="Profile.php">Profil</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

<span class="navbar-toggler-icon"></span>

</button>



<a class="navbar-brand" href="Articles.php">Adatbázis</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

<span class="navbar-toggler-icon"></span>

</button>



<a class="navbar-brand" href="logout.php">Kijelentkezés</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

<span class="navbar-toggler-icon"></span>

</button>

</div>










<div style="margin-top:80px;">




<h1>Üdvözöljük, <?php print $user["name"]?>!</h1>

<p><b>Jelszó változtatás</b></p>



<form action="profile_process.php" method="post">


<label for="password">Adja meg az új jelszavát!</label>

<br>

<input type="password" name="password" id="password">

<br><br>



<label for="password_confirmation">Erősítse meg az új jelszavát!</label>

<br>

<input type="password" name="password_confirmation" id="password">

<br><br>



<button type="submit" class="button" class="btn btn-outline-secondary">Jelszóváltoztatás</button>
<br><br><br>
<p><b>Jelszóval kapcsolatos követelmények:</b></p>
<ul>
  <li>Legalább nyolc karakterből kell állnia</li>
  <li>Tartalmazzon nagybetűt, kisbetűt és számot</li>
</ul>  



<?php

include("includes/message.php");

?>


</form>






<script>

document.querySelector('[href="logout.php"]').onclick = function (e){
let eredmeny = confirm('Biztosan ki szeretnél lépni?')
if (!eredmeny)
e.preventDefault();

}



</script>

</body>

</html>



<?php

unset($_SESSION["post"]);

?>