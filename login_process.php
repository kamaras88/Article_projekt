<?php

session_start();

$errors =[]; 
$success=[];

$connection = mysqli_connect('localhost', 'root', '', 'peter');

if ($err = mysqli_connect_error()) {
    exit($err);
}




$name = $_POST["name"];
$password = $_POST["password"];

$sql = mysqli_query($connection, "select * from users where name = '$name'");
   if (mysqli_num_rows($sql) === 1) { 
        $user = mysqli_fetch_assoc($sql); 
    } else {
        $errors[] = 'A Felhasználó nem található a rendszerünkben!'; 
    }


    if (isset($user)) { 
    $result = password_verify($password, $user["password"]);
    if( !$result){ 
        $errors[] = 'A jelszó nem megfelelő!';
    }
}

if (count($errors) === 0) {
    $_SESSION["authuserId"] = $user["id"];
    $_SESSION["success"] = "A belépés sikeres volt!";

    header("Location: profile.php"); 

} else {
    $_SESSION["post"] = $_POST;
    $_SESSION["errors"] = $errors;
    header("location:" . $_SERVER["HTTP_REFERER"]);
}

?>