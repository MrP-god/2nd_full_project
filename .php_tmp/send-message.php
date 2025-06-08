<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["author"]) && isset($_POST["message"])){
            $currentTimestamp = time();
            $formattedDate = date('d/m/y H:i', $currentTimestamp);
            $author = $_POST["author"];
            $message = $_POST["message"];
            $room = $_POST["room"];
            $dirrectory = "../rooms/". $room . ".txt";
            echo $dirrectory;
            $file = fopen($dirrectory, "a");
            
            $text = "\n{$author}|{$message}|{$formattedDate}|";
            fwrite($file, $text);
            fclose($file);
            header("Location: ../chat.php?username={$author}&room={$room}");
            exit;
        }
    }
?>