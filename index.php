
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Time Chat app</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.14"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
</head>
<body class="w-screen h-screen overflow-hidden font-[Poppins] bg-gradient-to-b from-orange-400 to-orange-500 p-10">
    <main class="w-full h-full bg-white shadow-2xl rounded-md grid grid-rows-12 grid-cols-12">
        <header class="row-span-1 col-span-12 bg-yellow-500">
            <!-- section to personalize look and settings -->
        </header>
        <div class="row-span-11 col-span-2 bg-yellow-400">
             <!--where there are the group chats  -->
            <div>
                <!-- search for a group chat -->
            </div>
            <div>
                <!-- list of group chat u are in -->
            </div>
        </div>
        <div class=" col-span-10 row-span-11 flex flex-col">
            <!-- messages of the group chat -->
            <div class="flex-1 overflow-auto" id="messages-container">
                <!-- list messages -->
                 <?php 
                    $file = fopen("messages.txt", "r");
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

                 ?>
            </div>
            <div>
                <!-- write message -->
                 <form class="flex h-10 " action="send-message.php" method="post">
                    <input type="text" name="author" placeholder="name" required class="px-5 w-[100px] outline-none">
                    <div class="h-8 w-0.5 bg-black"></div>
                    <input type="text" name="message" placeholder="message" required class="w-full  p-2">
                    <input type="submit" 
                    value="Send"
                    class="bg-gray-100 px-2 font-semibold w-[100px]">
                 </form>
            </div>
        </div>
    </main>
</body>
</html>