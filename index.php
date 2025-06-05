<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Hub</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <main>
        <form method="get" action="chat.php" class="flex flex-col">
            <input type="text" name="username" placeholder="Name" required>
            <button type="submit" name="room" value="general">general Room</button>
            <button type="submit" name="room" value="gaming">gaming Room</button>
            <button type="submit" name="room" value="coding">coding Room</button>
        </form>
    </main>
</body>
</html>