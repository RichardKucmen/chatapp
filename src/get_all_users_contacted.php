<?php
require "../classes/Login.php";
require "../classes/User.php";
require "../classes/Url.php";
require "../classes/Messages.php";
User::checkIfLoggedIn();
$database = new Login();
$connection = $database->connectionDB();
$user = User::getUserInfoWithID($connection, $_SESSION["user_id"]);
$all_messages = Messages::getAllMessagesByUserId($connection, $_SESSION["user_id"]);
$all_users = User::getAllUsers($connection);
$output = "";
$uniqueValues = [];
$user_already_contacted = [];
foreach ($all_messages as $message) {
    $outgoing_user_id = trim($message["outgoing_user_id"]);
    $ingoing_user_id = trim($message["ingoing_user_id"]);
    if($outgoing_user_id != trim($_SESSION["user_id"])){
        if (!isset($uniqueValues[$outgoing_user_id])) {
            $uniqueValues[$outgoing_user_id] = true;
            $outgoing_user_info = User::getUserInfoWithID($connection, $outgoing_user_id, "full_name, img, status");
            $user_already_contacted[$outgoing_user_id] = [
                "outgoing_user_id" => $outgoing_user_id,
                "full_name" => $outgoing_user_info[0]["full_name"],
                "img" => $outgoing_user_info[0]["img"],
                "message" => $message["message"],
                "status" => $outgoing_user_info[0]["status"]
            ];
        }
    } else {
        if (!isset($uniqueValues[$ingoing_user_id])) {
            $uniqueValues[$ingoing_user_id] = true;
            $ingoing_user_info = User::getUserInfoWithID($connection, $ingoing_user_id, "full_name, img, status");
            $user_already_contacted[$ingoing_user_id] = [
                "outgoing_user_id" => $ingoing_user_id,
                "full_name" => $ingoing_user_info[0]["full_name"],
                "img" => $ingoing_user_info[0]["img"],
                "message" => $message["message"],
                "status" => $ingoing_user_info[0]["status"]
            ];
        }
    }
}
if(isset($_SESSION["last_msg"])){
    $actual_time = time();
    if($actual_time > $_SESSION["last_msg"] + 10){
        User::changeStatus($connection, $_SESSION["user_id"], "offline");
    } else{
        User::changeStatus($connection, $_SESSION["user_id"], "online");
    }
}
foreach($user_already_contacted as $user_id => $user_info){
    if(!empty($user_info["message"])){
        $output .= ' <form action="" method="POST" class="users_form full_name">
        <input type="hidden" name="outgoing_user_id" value="'.$user_info["outgoing_user_id"].'">
        <button class="one_chat flex flex-row w-[370px] h-[90px] ml-[2px] pl-[20px] cursor-pointer pt-[8px] rounded-lg transition-all mb-[10px]">
            <img src="../public/uploads/'. $user_info["img"] .'" class="w-[70px] h-[70px] rounded-full" alt="">
            <div class="flex flex-col">
                <div class="flex flex-row">
                    <h1 class="text-[white] text-[20px] pl-[15px] pt-[5px] w-[250px] text-left">'. $user_info["full_name"] .'</h1>';
                    $output .= ($user_info["status"] == "online") ? '<div class="w-[20px] h-[20px] bg-[green] rounded-full relative top-[25px]"></div>' : '';
        $output .= '</div>
                <p class="text-[#989898] flex text-[15px] pl-[15px]">'. mb_strimwidth($user_info["message"], 0, 20, "...") .'</p>
            </div>
        </button>
    </form>';
    
    }
}

echo($output);




?>