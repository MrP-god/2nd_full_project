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
    <main class="w-screen h-screen p-4 flex flex-col justify-start gap-15 items-center py-[150px]">
        <h1 class="text-3xl md:text-4xl  font-extrabold text-blue-900">Miscord</h1>
        <form method="get" action="chat.php" class=" flex flex-col 
        w-[300px]">
            <div class="mb-10 bg-white rounded-md  flex justify-between p-2">
                <input type="text" name="username" placeholder="Name" required class="bg-white rounded-md outline-none">
                 <!-- <input type="color" name="color" value="#86A8E7" class="w-10 h-10 border-none"> -->
            </div>
            
            <div class="flex flex-col gap-3">
                <button type="submit" name="room" value="general" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">general Room</button>
                <button type="submit" name="room" value="gaming" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">gaming Room</button>
                <button type="submit" name="room" value="coding" class=" p-3 rounded-md bg-blue-200 border border-blue-500 text-blue-400 font-semibold">coding Room</button>
            </div>
            
        </form>
    </main>
</body>
</html>