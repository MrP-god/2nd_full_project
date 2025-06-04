<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["author"]) && isset($_POST["message"])){
            $currentTimestamp = time();
            $formattedDate = date('d/m/y H:i', $currentTimestamp);
            $author = $_POST["author"];
            $message = $_POST["message"];
            $file = fopen("messages.txt", "a");
            
            $text = "\n{$author}|{$message}|{$formattedDate}|";
            fwrite($file, $text);
            fclose($file);
            header("Location: index.php");
        }
    }
?>