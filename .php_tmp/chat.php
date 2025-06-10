
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
    <style>
        #emoji-category-anchors  a{
            text-decoration: none;
            color: #6B7280;
        }
        #emoji-category-anchors  a:hover{
            color: #60A5FA;
        }
    </style>
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
            
            <section>
            <!-- write message -->
                    <div class="flex h-15" >
                        <div class="flex bg-blue-100 w-full px-3 m-2 rounded-full">
                            <button @click="open = !open" class="text-xl"><i class="fa-regular fa-face-smile"></i></button>
                            <form action="api/send-message.php" method="post" class="w-full">
                                <input type="hidden" name="author" value="<?php echo $_GET["username"]?>">
                                <input type="hidden" name="room" value="<?php echo $_GET["room"]?>">
                                <input id="message-input" type="text" name="message" placeholder="message" required class="w-full p-2 outline-none">
                                <input type="submit" value="Send" class="hidden">
                            </form>
                        </div>    
                    </div>
            </section>
            <section x-show="open" @click.outside="open = false" class="w-full h-4/10 flex flex-col ">
                    <div class="flex-1 overflow-y-auto overflow-x-hidden " id="emoji-container">
                        <!-- emoji list goes here -->
                         <script>
                            document.addEventListener("DOMContentLoaded", ()=>{
                                // create elements
                                const emojiPicker = document.getElementById("emoji-container");

                                // fetch emojies and display them in grid
                                fetch("api/retrive-emoji.php")
                                    .then(response => {return response.json()})
                                    .then(data => {
                                        Object.keys(data).forEach(key =>{

                                            const categoryContainer = document.createElement("div");

                                            const EmojiContainer = document.createElement("div");
                                            EmojiContainer.className = "mx-2";

                                            const categoryTitle = document.createElement("p");
                                            categoryTitle.id = `emoji-${key}`;
                                            console.log(categoryTitle.id);
                                            
                                            categoryTitle.className = "mx-2 my-3 font-semibold text-sm";
                                            categoryTitle.textContent = key;

                                            categoryContainer.appendChild(categoryTitle);
                                            emojiPicker.appendChild(categoryContainer);
                                            // loop items
                                            data[key].forEach(item =>{
                                                const emoji = document.createElement("span");
                                                emoji.className = "text-3xl hover:bg-gray-200 rounded-md cursor-pointer"
                                                emoji.textContent = item;
                                                EmojiContainer.appendChild(emoji); 
                                            });;
                                            emojiPicker.appendChild(EmojiContainer);
                                        });
                                    })
                                    .catch(error => console.error(error));
                                });
                         </script>
                    </div>
                    <div id="emoji-category-anchors" class="p-1 flex justify-evenly border-t-1 border-gray-200 text-black h-10 text-lg">
                        <!-- emoji categories goes here -->
                        <a href="#emoji-Smiley & People" ><i class="fa-solid fa-face-smile"></i></a>
                        <a href="#emoji-Nature"><i class="fa-solid fa-paw"></i></a>
                        <a href="#emoji-Food" ><i class="fa-solid fa-mug-hot"></i></a>
                        <a href="#emoji-Activities"><i class="fa-solid fa-volleyball"></i></a>
                        <a href="#emoji-Travel"><i class="fa-solid fa-car"></i></a>
                        <a href="#emoji-Objects"><i class="fa-solid fa-lightbulb"></i></a>
                        <a href="#emoji-Symbols"><i class="fa-solid fa-icons"></i></a>
                    </div>
            </section>
        </main>
    </div>

</body>
</html>