
<?php
    include "utility/utilFunctions.php";
    


    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $usersPath = "db/users.txt";
        $users = getFileArray($usersPath);
        $currentUsername = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
        $isNewUsername = checkUsernameExists($users, $currentUsername);

        if($isNewUsername){ // enter only if username check is valid    
            if($_POST["password"] === $_POST["repeated-password"]){//enter only if passwords are the same
                // if new username with same password - save them into db + redirect to login

                $currentTime = time();

                $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
                
                $file = fopen($usersPath, "a");
                $line = "{$currentUsername}|{$hashPassword}|{$currentTime}|{$currentTime}|\n";

                fwrite($file, $line);
                fclose($file);
                header("Location: login.php");
            }else{
                $error =  "password don't match!";
            }
        }else{
            $error = "Username already been used";
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
        class="w-[300px] h-[400px] bg-gray-100 rounded-md shadow-md flex flex-col justify-center items-center gap-5 p-4">
            <h2 class="text-xl font-semibold mt-4 tracking-tighter">Welcome to Miscord</h2>
            <?php if(!empty($error)): ?>
                <div class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-md border-red-500 border"><?php echo htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <input type="text" name="username" placeholder="username" class="bg-blue-100 p-2 rounded-md outline-none w-full" required>
            <input type="password" name="password" placeholder="password" class="bg-blue-100 p-2 rounded-md outline-none w-full" required>
            <input type="password" name="repeated-password" placeholder="reapeat password" class="bg-blue-100 p-2 rounded-md outline-none w-full" required>
            <button type="submit" name="register" class="bg-blue-300 text-white rounded-md p-2 font-bold w-full shadow-xs tracking-tighter">Register</button>
            <p class="text-xs tracking-tighter">Already have account? <a href="login.php" class="hover:text-blue-500"><strong>Log In</strong></a></p>
        </form>
    </main>
    
</body>
</html>

