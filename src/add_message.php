<?php
session_start();
if(isset($_SESSION['user_id'])){
    require "../classes/Login.php";
    require "../classes/Messages.php";
    require "../classes/User.php";
    $database = new Login();
    $connection = $database->connectionDB();
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    if(!empty($message)){
        Messages::addMessage($connection, $incoming_id, $outgoing_id, $message);
    }
    $_SESSION["last_msg"] = time();
}
?>