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
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body class="bg-blue-100 overflow-hidden font-[Poppins]">
    <header class="flex justify-end items-center">
    <h1 class="mr-auto text-2xl font-extrabold text-blue-900 tracking-tighter">Miscord</h1>
        <?php if(empty($_SESSION["logged"])): ?>
            <a href="register.php">[Register]</a>
            <a href="login.php">[login]</a>
        <?php else: ?>
            <button hx-trigger="click" hx-post="api/logout.php" class="text-red-700">[Logout]</button>
        <?php endif; ?>
        
    </header>
    <main class="w-screen h-screen p-4 flex flex-col justify-start gap-2 items-center py-[150px]">

        <form method="get" action="chat.php" class=" flex flex-col gap-10 
        w-[300px]">
            <?php if(!empty($_SESSION["logged"])): ?>
                <p class="text-center p-2">Welcome back <span class="text-cyan-400 font-bold"><?php echo $_SESSION["username"] ?></span>, where do u want to chat?</p>
            <?php else: ?>
                <p class="text-center p-2">U are logged as <span class="text-cyan-400 font-bold">GUEST</span></p>
                <?php $_SESSION["username"] = "guest" ?>
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