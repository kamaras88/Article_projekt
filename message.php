<?php


if (isset($_SESSION["errors"])) {
    echo '<div class="error-message">';
    foreach ($_SESSION["errors"] as $errorMsg) {
        echo htmlspecialchars($errorMsg) . '<br>';
    }
    echo '</div>';
    unset($_SESSION["errors"]);
}


if (isset($_SESSION ["success"]))
{
    print($_SESSION ["success"]); 
    unset($_SESSION["success"]);
} 



?>