<?php
    session_start();
    include "../utility/utilFunctions.php";
    include "../utility/unread-functions.php";



    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["message"])){
            $filePath = "";

            $currentTimestamp = time();
            $formattedDate = date('d/m/y H:i', $currentTimestamp);
            // TODO: add here activity time update
            $author = $_SESSION["username"];
            $message = $_POST["message"];
            $room = $_POST["room"];
            $filePath = checkFilePath($room);
            $file = fopen($filePath, "a");
            
            $text = "{$author}|{$message}|{$formattedDate}|\n";
            fwrite($file, $text);
            fclose($file);
            // if($_SESSION["username"] !== "guest"){
            //     saveLastActivityUser($_SESSION["username"],"../db/users.txt");
            // }
            if($_SESSION["username"] !== "guest"){
                saveActivityUser($_GET["room"], "db/user_Activity/". $_SESSION["username"] ."_last_read.txt");
            }
            header("Location: ../chat.php?&room={$room}");
            exit;
        }
    }
?>