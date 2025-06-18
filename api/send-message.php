<?php
    session_start();
    include "../utility/utilFunctions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["message"])){

            $currentTimestamp = time();
            $formattedDate = date('d/m/y H:i', $currentTimestamp);
            // TODO: add here activity time update
            $author = $_SESSION["username"];
            $message = $_POST["message"];
            $room = $_POST["room"];
            $dirrectory = "../db/rooms/". $room . ".txt";
            $file = fopen($dirrectory, "a");
            
            $text = "{$author}|{$message}|{$formattedDate}|\n";
            fwrite($file, $text);
            fclose($file);
            if($_SESSION["username"] !== "guest"){
                saveLastActivityUser($_SESSION["username"],"../db/users.txt");
            }
            header("Location: ../chat.php?&room={$room}");
            exit;
        }
    }
?>