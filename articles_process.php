<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'peter');

if ($err = mysqli_connect_error()) {
    exit($err);
}

if (!isset($_SESSION["authuserId"])) {
    exit('Jelenleg nem vagy belépve!<a href = "login.php">Tovább a belépés oldalra</a>');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["DeleteId"])) {
        $idToDelete = $_POST["DeleteId"];

        $sql = "DELETE FROM article WHERE id = $idToDelete";
        if (mysqli_query($connection, $sql)) {
            echo "Sikeres törlés!";
            header("Location: Articles.php");
            exit();
        } else {
            echo "Hiba a törlés során: " . mysqli_error($connection);
        }
    }

    if (isset($_POST["Addtitle"], $_POST["Addauthor"], $_POST["Addcontent"])) {
        $title = $_POST["Addtitle"];
        $author = $_POST["Addauthor"];
        $content = $_POST["Addcontent"];
        $link = isset($_POST["Addlink"]) ? $_POST["Addlink"] : null;

        $sql = "INSERT INTO article (author, content, title, link) VALUES ('$author', '$content', '$title', '$link')";

        if (mysqli_query($connection, $sql)) {
            echo "Sikeres hozzáadás!";
            header("Location: Articles.php");
            exit();
        } else {
            echo "Hiba a hozzáadás során: " . mysqli_error($connection);
        }
    }
}
?>