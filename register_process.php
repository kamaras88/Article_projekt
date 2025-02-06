<?php

//appworld-hu --> appworld
//Admin --> kamaras
//Testuser --> user1
//Testuser2 --> user2
//Testuser2 --> user3


session_start();

$connection = mysqli_connect('localhost', 'root', '', 'peter');

if ($err = mysqli_connect_error()) {
    exit($err);
}


$name = $_POST["name"];
$role = $_POST["role"];
$password = $_POST["password"];


$errors = [];

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

print_r($_POST);



    $sql = "INSERT INTO users (name, role, password) VALUES ('$name', '$role', '$hashed_password')";

    $result = mysqli_query($connection, $sql);


header("location:" . $_SERVER["HTTP_REFERER"]);

?>