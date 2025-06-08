<?php 
include '../utility/utilFunctions.php';

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["room"])){
    $roomName = $_GET["room"];
    $messages = "";
    $chatUsers = [];
    $file = fopen("../rooms/{$roomName}.txt", "r");
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
                include "../message-template.php";
                $messages .= ob_get_clean();
            }
        }
        fclose($file);
        echo $messages;
    }
    exit;
}
?>