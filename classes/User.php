<?php

class User{
    public static function createUser($connection, $user_id, $full_name, $gmail, $password, $img){
        $sql = "INSERT INTO users (user_id, full_name, gmail, password, img)
        VALUES (:user_id, :full_name, :gmail, :password, :img)";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindValue(":full_name", $full_name, PDO::PARAM_STR);
        $stmt->bindValue(":gmail", $gmail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":img", $img, PDO::PARAM_STR);
        $stmt->execute();
    }
    public static function renameImg($img_name, $img_size, $img_tmp_name, $img_error){
        if ($img_error == 0){
            if($img_size > 9000000){
                $error_msg = "Subor je moc velky!";
                echo($error_msg);
            } else{
                $img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed_types = ["jpg", "png", "jpeg", "webp"];
                if(in_array($img_type, $allowed_types)){
                    $new_img_name = uniqid("IMG-", true). "." .$img_type;
                    if(!file_exists("../public/uploads/")){
                        mkdir("../public/uploads/", 0777, true);
                    } 
                    $image_upload_path = "../public/uploads/". $new_img_name;
                    move_uploaded_file($img_tmp_name, $image_upload_path);
                    return $new_img_name;
                }
            }
        }
    }
    public static function getUserInfoWithID($connection, $user_id, $column = "*"){
        $sql = "SELECT $column FROM users WHERE user_id = :user_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function getUserId($connection, $gmail){
        $sql = "SELECT user_id FROM users WHERE gmail = :gmail";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":gmail", $gmail, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function checkIfLoggedIn(){
        session_start();
        if(isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"]){
    
        } else{
            echo("Nemas povolenie");
            exit;
        }
    }
    public static function getAllUsers($connection){
        $sql = "SELECT * FROM users";
        $stmt = $connection->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function checkIfAccountExist($connection, $gmail){
        $sql = "SELECT * FROM users WHERE gmail = :gmail";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":gmail", $gmail, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function verifyUser($connection, $gmail, $password){
        $sql = "SELECT password FROM users WHERE gmail = :gmail";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":gmail", $gmail, PDO::PARAM_STR);
        if($stmt->execute()){
            if($user = $stmt->fetch()){
                return password_verify($password, $user[0]);
            }
        }
    }
    public static function changeStatus($connection, $user_id, $status){
        $sql = "UPDATE users SET status = :status WHERE user_id = :user_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
    }
}