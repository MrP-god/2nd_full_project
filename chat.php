
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_GET["room"] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.14"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
</head>
<body class="w-screen h-screen overflow-hidden font-[Poppins] bg-gradient-to-l from-blue-200 to-blue-100 pb-10 px-20 flex flex-col min-h-screen justify-start items-center ">
    <p class=" text-xl font-semibold text-blue-900 "><?php echo $_GET["room"] ." room"?></p>
    <main class=" mb-10 bg-white shadow-2xl rounded-md 
    w-[330px] h-full
    md:w-[500px] md:w-[700px]
    lg:min-h-full lg:w-full
    flex flex-col">
        <!-- messages of the group chat -->
        <a href="index.php"> <button class="w-[60px] h-[30px] bg-blue-300 rounded m-2 p-1"><i class="fa-solid fa-arrow-left text-white "></i></button></a>
        <div class="flex-1 overflow-auto" id="messages-container">
        <!-- list messages -->
            <script>
                const messageContainer = document.getElementById("messages-container");

                fetch("get-message.php?room=<?php echo $_GET['room'] ?>")
                        .then(response =>{
                            // console.log(response.text());
                            return response.text();
                        })
                        .then(data=>{

                            // console.log(data);
                            messageContainer.innerHTML = data;
                            // Wait for DOM to update
                            setTimeout(() => {
                                messageContainer.scrollTop = messageContainer.scrollHeight;
                            }, 50);
                        })
                        .catch(error => console.error(error));
                // fetching new messages
                
                setInterval(() => {
                    fetch("get-new-messages.php?room=<?php echo $_GET['room'] ?>")
                        .then(response =>{
                            // console.log(response.text());
                            return response.text();
                        })
                        .then(data=>{
                            if(data.trim() !== ""){
                                // console.log(data);
                                messageContainer.insertAdjacentHTML("beforeend", data);
                                // messageContainer.scrollTop = messageContainer.scrollHeight;

                                // Wait for DOM to update
                                setTimeout(() => {
                                    messageContainer.scrollTop = messageContainer.scrollHeight;
                                }, 50);
                            }
                        })
                        .catch(error => console.error(error));
                }, 3000);
            </script>
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