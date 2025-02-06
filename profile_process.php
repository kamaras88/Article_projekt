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

$password = $_POST["password"];
$password_confirmation = $_POST["password_confirmation"];

$errors = [];
$success = [];

// Jelszó ellenőrzése
if (strlen($password) < 8) {
    $errors[] = "A jelszó legalább 8 karakter hosszú kell, hogy legyen!";
}

if (!preg_match('/[a-z]/', $password)) {
    $errors[] = "A jelszó tartalmaznia kell kisbetűt!";
}

if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "A jelszó tartalmaznia kell nagybetűt!";
}

if (!preg_match('/[0-9]/', $password)) {
    $errors[] = "A jelszó tartalmaznia kell számot!";
}

if ($password !== $password_confirmation) {
    $errors[] = "A két jelszó nem egyezik!";
}

if (empty($errors)) {

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = '$hashed_password' WHERE id = {$_SESSION['authuserId']}";

    if (mysqli_query($connection, $sql)) {
        $_SESSION["success"] = [];
        $_SESSION["success"][] = "A jelszó sikeresen megváltoztatva!";
        header("Location: profile.php");

    } else {
        $errors[] = "Hiba a jelszó módosítása során: " . mysqli_error($connection);
    }
}


if (count($errors) > 0) {
    $_SESSION["post"] = $_POST;
    $_SESSION["errors"] = $errors;
    header("location:" . $_SERVER["HTTP_REFERER"]);
}

?>