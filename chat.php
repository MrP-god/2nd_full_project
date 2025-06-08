
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_GET["room"] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="w-screen h-[100vh] overflow-hidden font-[Poppins] m-0 p-0 bg-gradient-to-l from-blue-200 to-blue-100">
    <div class="fixed inset-0 md:p-5 flex justify-center items-center">
        <main class="bg-white shadow-2xl box-border w-full h-full flex flex-col" x-data="{open: false}">   
            <!-- messages of the group chat -->        <div class=" flex items-center">
                <a href="index.php"> <button class="w-[60px] h-[30px] bg-blue-300 rounded m-2 p-1"><i class="fa-solid fa-arrow-left text-white "></i></button></a>
                <p class=" text-xl font-semibold text-blue-900 ml-auto mr-5"><?php echo $_GET["room"] ." room"?></p>
            </div>
        
            <div class="flex-1 overflow-y-auto overflow-x-hidden border-b-1 border-gray-200 min-h-0" id="messages-container">
            <!-- list messages -->
                <script>
                    const messageContainer = document.getElementById("messages-container");

                    fetch("api/get-message.php?room=<?php echo $_GET['room'] ?>")
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
                        fetch("api/get-new-messages.php?room=<?php echo $_GET['room'] ?>")
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
            
            <div >
            <!-- write message -->
                    <section class="flex h-15" >
                        <div class="flex bg-blue-100 w-full px-3 m-2 rounded-full">
                            <button @click="open = !open" class="text-xl"><i class="fa-regular fa-face-smile"></i></button>
                            <form action="api/send-message.php" method="post" class="w-full">
                                <input type="hidden" name="author" value="<?php echo $_GET["username"]?>">
                                <input type="hidden" name="room" value="<?php echo $_GET["room"]?>">
                                <input id="message-input" type="text" name="message" placeholder="message" required class="w-full p-2 outline-none">
                                <input type="submit" value="Send" class="hidden">
                            </form>
                        </div>    
                    </section>
            </div>
            <section x-show="open" @click.outside="open = false" class="w-full md:w-5/10 h-4/10">
                    <div>
                        <!-- emoji list goes here -->
                    </div>
                    <div>
                        <!-- emoji categories goes here -->
                        <button value="smileys">😀</button>
                        <button value="people">👶</button>
                        <button value="hands">🤚</button>
                        <button value="animals">🐱</button>
                        <button value="food">🍎</button>
                        <button value="travel">🚗</button>
                        <button value="objects">⌚</button>
                        <button value="symbols">✝️</button>
                        <button value="activities">⚽</button>
                        <button value="nature">🌳</button>
                    </div>
            </section>
        </main>
    </div>

</body>
</html>