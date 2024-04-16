<?php  
require "../classes/Login.php";
require "../classes/User.php";
require "../classes/Url.php";
require "../classes/Messages.php";
$database = new Login();
$connection = $database->connectionDB();

User::checkIfLoggedIn();
$user = User::getUserInfoWithID($connection, $_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/44678bafea.js" crossorigin="anonymous"></script>
</head>
<body>
    <main class="flex justify-center items-center h-[100vh]">
        <div class="chatting_app_container flex w-[1400px] bg-[#121212] h-[900px]">
             <div class="all_chats w-[400px] bg-[#121212] border-solid border-2 border-[#4a4a4a]">
                <div class="flex flex-row w-[300px] justify-left ml-[50px] mt-[30px]">
                    <img src="../public/uploads/<?= $user[0]["img"] ?>" class="w-[70px] h-[65px]" alt="">
                    <h1 class="text-[#00a3ff] ml-[10px] text-[30px] pt-[10px]"><?= $user[0]["full_name"] ?></h1>
                </div>
               <div class="flex flex-row w-[360px] justify-between ml-[20px] mt-[30px] ">
              
                        <input type="text" class="w-[300px] h-[50px] rounded-lg pl-[10px] outline-none border-solid border-2 border-[#4a4a4a] bg-[#181818] text-[white]"  placeholder="Search messages, people" id="search_form">
              
                        <form action="" method="POST" class="users_form">
                        <input type="hidden" name="outgoing_user_id" value="add_contact">
                        <button class="bg-[#00a3ff] text-[40px] h-[50px] w-[50px] pb-[25px] text-[white] rounded-lg"><i class="fa-solid fa-plus relative bottom-1"></i></button>
                        </form>
               </div>
               <div class="chats_container mt-[30px] h-[700px] overflow-y-auto overflow-x-hidden">   
                </div>   
    </div>
        <div class="all_users flex w-[1000px] h-[900px]"  data-twe-perfect-scrollbar-init>

        </div>
          <div class="chat hidden w-[1000px] bg-[#181818]  flex-col h-[900px]"  data-twe-perfect-scrollbar-init>
          
            <div class="chat_body h-[670px] w-[1000px] bg-[#121212] p-[30px] overflow-x-hidden overflow-auto" id="chat_box">
            </div>
                <div class="chat_footer p-[30px]">
                    <form method="POST" id="form_input">
                        <input type="hidden" name="incoming_id" id="incoming_id" value="uwuwuuuw">
                        <input type="text" class="w-[90%] p-[15px] rounded-lg  border-solid border-2 border-[#4a4a4a] bg-[transparent] outline-none text-[white]" placeholder="Your message" id="input" name="message">
                        <button class="p-[15px] bg-[#00a3ff] text-[white] rounded-lg" id="send_btn"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
    </main>
    <script src="../public/js/script.js"></script>
</body>
</html>

<!-- #181818 -->
<!-- #121212 -->
<!-- #00a3ff -->
<!-- #292929 -->