<?php 
include '../utility/utilFunctions.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $roomName = $_GET["room"];
    if(isset($_GET["room"])){
        $file = fopen("../rooms/{$roomName}.txt", "r");
        if($file){
            $lastLine = "";
            while(($line = fgets($file)) !== false){
                $lastLine = $line;
            }
            $parts = explode("|",$lastLine);
            if(count($parts) >= 3){
                list($author, $message, $timestamp) = $parts;
                $color = getUserColor($author);
                $messageWithLinks = replaceLinks($message);

                ob_start();
                include "../message-template.php";
                $template = ob_get_clean();
            }
            fclose($file); 
        }
    }
    exit;
}
?>