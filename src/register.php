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
    <main class="w-[100%] h-[100vh] flex flex-col justify-center items-center gap-1 bg-[#181818]">
        <form action="create_user.php" enctype="multipart/form-data" class="flex flex-col gap-[20px]" method="post">
            <input type="text" name="full_name" class="w-[100%] p-[15px] rounded-lg  border-solid border-2 border-[#4a4a4a] bg-[transparent] outline-none text-[white]" placeholder="Meno" required>
            <input type="text" name="gmail" class="w-[100%] p-[15px] rounded-lg  border-solid border-2 border-[#4a4a4a] bg-[transparent] outline-none text-[white]" placeholder="Gmail" required>
            <input type="password" name= "password" class="w-[100%] p-[15px] rounded-lg  border-solid border-2 border-[#4a4a4a] bg-[transparent] outline-none text-[white]" placeholder="Password" required>
            <input type="file" name="img">
            <button class="text-[white]">Submit</button>
        </form>
    </main>
</body>
</html>

<!-- #181818 -->
<!-- #121212 -->
<!-- #00a3ff -->
<!-- #292929 -->