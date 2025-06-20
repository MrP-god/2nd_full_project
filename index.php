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
                    <button class="w-full pl-5 p-3 grid  grid-cols-6 grid-rows-2 hover:bg-yellow-100 rounded-md" 
                    type="submit" name="room" value="<?= htmlspecialchars($room) ?>">
                        <p class=" col-span-5 row-span-2 font-bold tracking-tighter flex justify-start items-center"><span><?= htmlspecialchars($room) ?></span></p>
                        <div class=" text-xs"> 12:33</div>
                        <div id="unread-<?php echo $room ?>" class="flex justify-center items-center text-black">
                        </div>
                    </button>
                <?php endforeach; ?>

                <script>
                    const rooms = <?php echo json_encode($cleanRooms); ?>;
                    let unreadList = [];
                    // every 3ms do an ajax call to check if user has new message 
                    setInterval(() => {
                        rooms.forEach((room) => {
                            fetch(`api/unread-messages.php?room=${room}`)
                            .then(response => {return response.text();})
                            .then(text =>{
                                if(text > 0){
                                    document.getElementById(`unread-${room}`).textContent = text;
                                }
                                unreadList.push(text);
                            })
                            .catch(error => console.error(error));
                        });
                        console.log(unreadList);
                        unreadList = [];
                    }, 500);
                </script>
            </form>
        </main>
    </div>
    
</body>
</html>