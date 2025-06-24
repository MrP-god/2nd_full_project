<?php 
include '../utility/utilFunctions.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $roomName = $_GET["room"];
    $clientMessagesCount = $_GET["message_count"];
    $messagsSent = 0;

    if(isset($_GET["room"])){
        
        $filePath = checkFilePath($roomName);

        if(file_exists($filePath)){

            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $totalMessages = count($lines);
            
            if($clientMessagesCount < $totalMessages){
                // error_log("client messages: ". $clientMessagesCount. " Server Messages: ". $totalMessages. " -> SENDING NEW MESSAGES");
                $newMessages = [];

                for($i = $clientMessagesCount; $i < $totalMessages; $i++){
                    $line = $lines[$i];
                    $parts = explode("|", $line);
                    $messagsSent++;

                    if(count($parts) >= 3){

                        list($author, $message, $timestamp) = $parts;
                        // $user = $_SESSION["username"];
                        $color  = getUserColor($author);
                        $messageWithLinks = replaceLinks($message);
                        
                        // open message template
                        
                        ob_start();
                        include "../templates/message-template.php";
                        $newMessages[] = ob_get_clean();
                    }
                }
                echo implode("", $newMessages);  
                error_log("new messages sent: ". $messagsSent);
            }
        }
    }
    exit;
}
    
?>