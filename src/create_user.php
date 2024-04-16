<?php
require "../classes/Login.php";
require "../classes/User.php";
require "../classes/Url.php";
$database = new Login();
$connection = $database->connectionDB();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = $_POST["full_name"];
    $gmail = $_POST["gmail"];
    $full_password = $_POST["password"];
    $img_name = $_FILES["img"]["name"];
    $img_size = $_FILES["img"]["size"];
    $img_tmp_name = $_FILES["img"]["tmp_name"];
    $img_error = $_FILES["img"]["error"];
    $img = User::renameImg($img_name, $img_size, $img_tmp_name, $img_error);
    $user_id = password_hash("id", PASSWORD_DEFAULT);
    $password = password_hash($full_password, PASSWORD_DEFAULT);
    if(User::checkIfAccountExist($connection, $gmail) != ""){
        User::createUser($connection, $user_id, $full_name, $gmail, $password, $img);
        session_start();
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_logged_in"] = "true";
        Url::moveClient("/chatting/src/dashboard.php");
    } else{
        echo("Chybne udaje");
    }
    
} else{
    echo("Chod prec");
}