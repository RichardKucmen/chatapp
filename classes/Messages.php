<?php

class Messages{
    public static function getAllMessagesByUserId($connection, $user_id, $column = "*"){
        $sql = "SELECT $column FROM messages WHERE ingoing_user_id = :ingoing_user_id OR outgoing_user_id = :ingoing_user_id  ORDER BY id DESC";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":ingoing_user_id", $user_id, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function getAllMessagesWithUser($connection, $ingoing_user_id, $outgoing_user_id, $column = "*"){
        $sql = "SELECT $column FROM messages WHERE ingoing_user_id = :ingoing_user_id AND outgoing_user_id = :outgoing_user_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":ingoing_user_id", $ingoing_user_id, PDO::PARAM_STR);
        $stmt->bindValue(":outgoing_user_id", $outgoing_user_id, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function getMessagesBetweenTwo($connection, $ingoing_user_id, $outgoing_user_id){
        $sql = "SELECT * FROM messages WHERE (ingoing_user_id = :ingoing_user_id AND outgoing_user_id = :outgoing_user_id) OR (outgoing_user_id = :ingoing_user_id AND ingoing_user_id = :outgoing_user_id) ORDER BY id";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":ingoing_user_id", $ingoing_user_id, PDO::PARAM_STR);
        $stmt->bindValue(":outgoing_user_id", $outgoing_user_id, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }
    }
    public static function addMessage($connection, $ingoing_user_id, $outgoing_user_id, $message){
        $sql = "INSERT INTO messages (ingoing_user_id, outgoing_user_id, message) VALUES (:ingoing_user_id, :outgoing_user_id, :message)";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":ingoing_user_id", $ingoing_user_id, PDO::PARAM_STR);
        $stmt->bindValue(":outgoing_user_id", $outgoing_user_id, PDO::PARAM_STR);
        $stmt->bindValue(":message", $message, PDO::PARAM_STR);
        $stmt->execute();
    }
}