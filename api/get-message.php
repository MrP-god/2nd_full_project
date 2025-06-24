<?php 
include '../utility/utilFunctions.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["room"])){
    $roomName = $_GET["room"];
    $messages = "";
    $chatUsers = [];
    $filePath = checkFilePath($roomName);

    $file = fopen($filePath, "r");
    if($file){
        while(($line = fgets($file)) !== false){
            $parts = explode("|",$line);
            if(count($parts) >= 3){
                list($author, $message, $timestamp) = $parts;
                if(!array_key_exists($author, $chatUsers)){
                    $chatUsers[$author] = getUserColor($author);
                }
                // styling
                $color = $chatUsers[$author];
                $messageWithLinks = replaceLinks($message);

                ob_start();
                include "../templates/message-template.php";
                $messages .= ob_get_clean();
            }
        }
        fclose($file);
        echo $messages;
    }
    exit;
}
?>