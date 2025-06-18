<?php
    
    include "utility/utilFunctions.php";
    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $usersPath = "db/users.txt";
        $users = getFileArray($usersPath);
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        $notExistUsername = checkUsernameExists($users, $username);//true if exists 
        foreach($users as $user){
            $parts = explode("|", $user);
            $hashPasswrd = $parts[1]; // i save only the has password from users

            if(password_verify($password, $hashPasswrd)){
                $correctPassword = true;
            } 
            $correctPassword = false;
        }

        if($notExistUsername){
            $error = "username invalid or not registered";
        }elseif($correctPassword){
            $error = "Wrong Password";
        }else{
            // save username in session and redirect to index page
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
            $_SESSION["last_activity"] = time();//this is for usavbility
            saveLastActivityUser($_SESSION["username"],"db/users.txt"); //this is for keeping track in case it log and stop using without logout
            header("Location: index.php");
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to Miscord</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>
    </style>
</head>
<body class="bg-blue-100 overflow-hidden font-[Poppins] w-full h-screen  overflow-hidden">
    <a href="index.php">[Go Back]</a>
    <main class="flex justify-center items-center w-full h-full">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post"
        class="w-[300px] h-[350px] bg-gray-100 rounded-md shadow-md flex flex-col justify-center items-center gap-5 p-4">
            <h2 class="text-xl font-semibold mt-4 tracking-tighter">Welcome Back</h2>
            <?php if(!empty($error)): ?>
                <div class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-md border-red-500 border"><?php echo htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <input type="text" name="username" placeholder="username" class="bg-blue-100 p-2 rounded-md outline-none w-full" required>
            <input type="password" name="password" placeholder="password" class="bg-blue-100 p-2 rounded-md outline-none w-full" required>
            <button type="submit" name="register" class="bg-blue-300 text-white rounded-md p-2 font-bold w-full shadow-xs tracking-tighter">Login</button>
            <p class="text-xs tracking-tighter">Don't have an account? <a href="register.php" class="hover:text-blue-500"><strong>Register now</strong></a></p>
        </form>
    </main>
    
</body>
</html>