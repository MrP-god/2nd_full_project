<?php
    session_start();
    $roomsParentPath = "/db/rooms";

    $roomsFiles = glob(__DIR__ . $roomsParentPath . "/*.txt");
    $cleanRooms = array_map(function($file){
        return basename($file, ".txt");
    }, $roomsFiles);

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
<body class="bg-blue-100 overflow-hidden font-[Poppins] w-screen h-[100vh]">
    <div class="fixed inset-0 flex justify-center items-center flex-col">
        <header class="flex justify-end items-center w-full">
            <h1 class="mr-auto text-2xl font-extrabold text-blue-900 tracking-tighter">Miscord</h1>
            <?php if(empty($_SESSION["logged"])): ?>
                <p class="tracking-tighter text-blue-400 font-bold">[guest]</p>
                <?php $_SESSION["username"] = "guest" ?>
                <a href="register.php">[Register]</a>
                <a href="login.php">[login]</a>
            <?php else: ?>
                <p class="tracking-tighter text-blue-400 font-bold">[<?php echo $_SESSION["username"] ?>]</p>
                <button hx-trigger="click" hx-post="api/logout.php" class="">[Logout]</button>
            <?php endif; ?> 
        </header>
        <main class="w-full h-full p-4 flex flex-col justify-start gap-2 items-center">

            <form method="get" action="chat.php" class=" flex flex-col 
            w-full h-full rounded-md bg-white ">

                <!-- here i have to loop all the rooms, x guest and user , ok how to differentialt rooms for each user  -->


                <?php foreach($cleanRooms as $room): ?>
                    <button class="w-full pl-5 p-3 grid  grid-cols-6 grid-rows-2 hover:bg-yellow-100" 
                    type="submit" name="room" value="<?= htmlspecialchars($room) ?>">
                        <p class=" col-span-5 row-span-2 font-bold tracking-tighter flex justify-start items-center">
                            <span>
                                <?= htmlspecialchars($room) ?>
                            </span>
                        </p>
                        <!-- <div class=" row-start-2 col-span-5"></div> -->
                        <div class=" text-xs"> 12:33</div>
                        <div class="flex justify-center items-center">
                            <div class="flex justify-center items-center text-[11px] rounded-full border text-white font-bold bg-blue-600 w-[22px] h-[22px]">3</div>
                        </div>
                        
                    </button>
                <?php endforeach; ?>

                


                
                
                <!-- <div class="flex flex-col gap-3">
                    <button type="submit" name="room" value="general" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">general Room</button>
                    <button type="submit" name="room" value="gaming" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">gaming Room</button>
                    <button type="submit" name="room" value="coding" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">coding Room</button>
                    <button type="submit" name="room" value="testing" class="text-yellow-700 p-3 rounded-md bg-yellow-200 border border-yellow-500 text-yellow-400 font-semibold">testing Room</button>
                </div> -->
            </form>
        </main>
    </div>
    
</body>
</html>