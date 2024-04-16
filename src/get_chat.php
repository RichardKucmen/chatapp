<?php 
    require "../classes/Messages.php";
    require "../classes/Login.php";
    require "../classes/User.php";
    $database = new Login();
    $connection = $database->connectionDB();
    $all_users = User::getAllUsers($connection);
    session_start();
    if(isset($_SESSION['user_id'])){
        $output = "";
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = $_GET["id"];
        $messages = Messages::getMessagesBetweenTwo($connection, $outgoing_id, $incoming_id);
            if(!empty($messages)){
                foreach($messages as $message){
                    if($message["outgoing_user_id"] == $outgoing_id){
                        $outgoing_user_info = User::getUserInfoWithID($connection, $outgoing_id, $column = "full_name, img");
                        $output .= '<div class="message ml-[40%] w-[60%] flex justify-end mb-[20px]">
                        <div class="flex flex-col">
                            <h1 class="text-[18px] pr-[5px] text-[white] flex justify-end">'. $outgoing_user_info[0]["full_name"] .'</h1>
                            <p class="p-[15px] bg-[#4a4a4a] text-[white] mr-[5px] rounded-lg">'.  $message["message"] .'</p>
                        </div>
                        <img src="../public/uploads/'. $outgoing_user_info[0]["img"] .'" class="w-[50px] h-[50px] rounded-full" alt="">
                    </div>';
                   } else{
                    $ingoing_user_info = User::getUserInfoWithID($connection, $incoming_id, $column = "full_name, img");
                    $output .= '<div class="message w-[60%] flex justify-start mb-[20px]">
                    <img src="../public/uploads/'. $ingoing_user_info[0]["img"] .'" class="w-[50px] h-[50px] rounded-full" alt="">
                    <div class="flex flex-col">
                        <h1 class="text-[18px] pl-[5px] text-[white]">'. $ingoing_user_info[0]["full_name"] .'</h1>
                        <p class="p-[15px] bg-[#4a4a4a] text-[white] ml-[5px] rounded-lg">'.  $message["message"] .'</p>
                    </div>
                </div>';
                   }
            }
        }
        echo($output);
    }

?>
