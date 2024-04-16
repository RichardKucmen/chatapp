<?php

class Login {
    public function connectionDB(){
        $db_host = "localhost";
        $db_name = "chat_app";
        $db_user = "root";
        $db_password = "";
        $connection = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            $db = new PDO($connection, $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo($e->getMessage());
            exit;
        }
}
}