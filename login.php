<?php 
    session_start();

    include('Data.php');


    if($_POST['username'] == $username && $_POST['password'] == $password){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        header('Location: dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="./assets/logo.png">
</head>
<body class="flex w-screen h-screen">
    <div class="flex items-center justify-center w-1/2 bg-neutral-200">
        <img src="./assets/logo.png" alt="" class="w-[20rem]">
    </div>
    <div class="flex flex-col items-center justify-center w-1/2">
        <div class="flex items-center justify-center w-max">
            <h2 class="font-bold text-4xl">LOGIN</h2>
            <img src="./assets/logo.png" alt="" class="w-8">
        </div>


        <form method="post" class="w-max h-max flex flex-col">
            <h5 class="text-neutral-500 tracking-wide mt-14 mb-2 font-light text-sm">Username</h5>
            <input name="username" type="text" class="border border-neutral-300 rounded-md px-3 py-2 w-[25rem]">
            <h5 class="text-neutral-500 tracking-wide mt-4 mb-2 font-light text-sm">Password</h5>
            <input name="password" type="text" class="border border-neutral-300 rounded-md px-3 py-2 w-[25rem]">

            <input type="submit" value="Login" class=" hover:bg-neutral-800 transition0-all duration-500
            w-[25rem] bg-neutral-200 font-semibold text-white text-lg rounded-lg py-2 mt-8">
            <div class="flex w-full justify-between text-[13px] mt-5">
                <a href="" class="text-neutral-300">Forgot password</a>
                <h5 class="text-neutral-300">Don't have an account? <a href="" class="text-blue-900 ml-1">Register Here</a></h5>
            </div>
        </form>
    </div>
</body>
</html>