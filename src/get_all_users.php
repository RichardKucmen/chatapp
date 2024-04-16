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
            foreach($all_users as $one_user){
                $output .= '
                <form action="" method="POST" class="add_user">
                <input type="hidden" name="outgoing_user_id" value="'. $one_user["user_id"] .'  ">
                <div class="all_users w-[100%] p-[20px] flex gap-5 flex-wrap justify-center overflow-x-hidden overflow-auto">
            <div class="user_box w-[250px] p-[10px] h-[110px] rounded-lg  border-solid border-2 border-[#4a4a4a]">
                <div class="flex">
                    <img src="../public/uploads/'. $one_user["img"] .'" class="w-[70px] h-[70px] rounded-full" alt="">
                    <div class="flex flex-col">
                    <h1 class="pl-[10px] text-[white] text-[20px]">'. $one_user["full_name"] .'</h1>
                    <button class="one_chat w-[100px] p-[15px] bg-[#00a3ff] text-[white] rounded-lg ml-[10px]"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div> 
        </form>';
            }
            echo($output);
        }

?>