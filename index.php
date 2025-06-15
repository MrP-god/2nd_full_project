<?php
    session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Hub</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.14"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body class="bg-blue-100 overflow-hidden font-[Poppins]">
    <header>
        <?php if(!$_SESSION["logged_in"]): ?>
            <a href="register.php">[Register]</a>
            <a href="login.php">[login]</a>
        <?php else: ?>
            <button hx-swap="none" hx-trigger="click" hx-post="api/logout.php" class="">[Logout]</button>
        <?php endif; ?>
    </header>
    <main class="w-screen h-screen p-4 flex flex-col justify-start gap-10 items-center py-[150px]">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900">Miscord</h1>
        <form method="get" action="chat.php" class=" flex flex-col gap-10 
        w-[300px]">
            <?php if(empty($_SESSION["username"])): ?>
            <div class="mb-10 bg-white rounded-md  flex justify-between p-2">
                <input type="text" name="username" placeholder="Name" required class="bg-white rounded-md outline-none">
            
            </div>
            <?php else: ?>
            <p class="text-center p-2">Welcome back <span class="text-cyan-400 font-bold"><?php echo $_SESSION["username"] ?></span></p>
            <?php endif; ?>
            
            
            <div class="flex flex-col gap-3">
                <button type="submit" name="room" value="general" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">general Room</button>
                <button type="submit" name="room" value="gaming" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">gaming Room</button>
                <button type="submit" name="room" value="coding" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">coding Room</button>
                <button type="submit" name="room" value="testing" class="text-yellow-700 p-3 rounded-md bg-yellow-200 border border-yellow-500 text-yellow-400 font-semibold">testing Room</button>
            </div>
            
        </form>
    </main>
</body>
</html>