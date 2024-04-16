<?php
require "../classes/Login.php";
require "../classes/User.php";
require "../classes/Url.php";
$database = new Login();
$connection = $database->connectionDB();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];
    if(User::verifyUser($connection, $gmail, $password)){
        $user_id = User::getUserId($connection, $gmail);
        session_start();
        session_set_cookie_params(10);
        $_SESSION["user_id"] = $user_id[0]["user_id"];
        $_SESSION["user_logged_in"] = "true";
        $_SESSION["last_msg"] = time();
        Url::moveClient("/chatting/src/dashboard.php");
    } else{
        echo("Chybne udaje");
    }
} else{
    echo("Chod prec");
}