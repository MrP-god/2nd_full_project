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
<body class="bg-blue-100 overflow-hidden font-[Poppins] w-screen h-[100vh]">
    <div class="fixed inset-0 flex justify-center items-center flex-col">
        <header class="flex justify-end items-center w-full px-4">
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


                 <section hx-get="api/fetch-rooms.php" hx-target="this" hx-trigger="revealed">
                    <!-- inside here will be fetched from server all the available rooms for the user -->
                 </section>


                <script>
                    let allRooms = [];
                    fetch("api/fetch-array-name-rooms.php")
                    .then(response =>{return response.json();})
                    .then(data => {
                        allRooms = data;
                        console.log(allRooms);
                    })
                    .catch(error => console.error(error));


                    function getNotification(room){
                        const notificationContainer = document.getElementById(`unread-${room}`);
                        fetch(`api/unread-messages.php?room=${room}`)
                        .then(response => {return response.text();})
                        .then(text =>{
                            notificationContainer.innerHTML = '';
                            if(text > 0){
                                const notification = document.createElement("div");
                                notification.textContent = text;
                                notification.className = "text-white font-semibold text-[10px] rounded-full bg-blue-600 w-[17px] h-[17px] flex justify-center items-center";
                                notificationContainer.appendChild(notification);
                            }
                        })
                        .catch(error => console.error(error));
                    }
                    
                    // every 3ms do an ajax call to check if user has new message 
                    setInterval(() => {
                        allRooms.forEach((room) => getNotification(room));

                    }, 500);
                </script>
            </form>
        </main>
    </div>
    
</body>
</html>