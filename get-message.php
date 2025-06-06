<?php 
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $roomName = $_GET["room"];
    $messages = "";
    $file = fopen("rooms/{$roomName}.txt", "r");
    if($file){
        while(($line = fgets($file)) !== false){
            $parts = explode("|",$line);
            list($author, $message, $timestamp) = $parts;

            ob_start();
            include "message-template.php";
            $template = ob_get_clean();
            $messages .= $template;
            
        }
        // error_log("Messages output: " . $messages);
        fclose($file);
        echo $messages;
        exit;
    }
}
?>