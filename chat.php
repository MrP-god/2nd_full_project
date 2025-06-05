
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Time Chat app</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.14"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
</head>
<body class="w-screen h-screen overflow-hidden font-[Poppins] bg-gradient-to-l from-blue-200 to-blue-100 p-10 flex flex-col min-h-screen justify-center items-center">
    <h2><?php echo $_GET["room"]?></h2>
    <main class=" bg-white shadow-2xl rounded-md 
    w-[330px] h-full
    md:w-[500px] md:w-[700px]
    lg:w-full lg:w-full
    flex flex-col">
        <!-- messages of the group chat -->
       
            <a href="index.php"> <button class="w-[60px] h-[30px] bg-blue-300 rounded m-2 p-1"><i class="fa-solid fa-arrow-left text-white "></i></button></a>
        
        <div class="flex-1 " id="messages-container">
        <!-- list messages -->
                <?php 
                if($_SERVER["REQUEST_METHOD"] == "GET"){
                    $roomName = $_GET["room"];
                    $file = fopen("rooms/{$roomName}.txt", "r");
                    if($file){
                        while(($line = fgets($file)) !== false){
                            $parts = explode("|",$line);
                            list($author, $message, $timestamp) = $parts;

                            ob_start();
                            include "message-template.php";
                            $template = ob_get_clean();
                            echo $template;
                        }
                    }
                }
                ?>
        </div>
        <div>
        <!-- write message -->
                <form class="flex h-10 rounded-md m-5 bg-blue-100 " action="send-message.php" method="post">
                    <input type="hidden" name="author" value="<?php echo $_GET["username"]?>">
                    <input type="hidden" name="room" value="<?php echo $_GET["room"]?>">
                    <input type="text" name="message" placeholder="message" required class="w-full p-2 outline-none">
                    <input type="submit" 
                    value="Send"
                    class="bg-blue-400 px-2 font-semibold w-[100px] rounded-r-md text-white">
                </form>
        </div>
    </main>
</body>
</html>