<?php

session_start ();

if (!isset ($_SESSION["authuserId"])){
    exit('Jelenleg nem vagy belépve!<a href = "login.php">Tovább a belépés oldalra</a>');
}

unset ($_SESSION["authuserId"]);

$_SESSION["success"] = 'Sikeres kilépés!';

header("location: login.php");

?>