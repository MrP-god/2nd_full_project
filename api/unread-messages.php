<?php 
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    error_log($_GET["room"]." - [".$_SESSION["username"]."]");
    $userActivityPath = "../db/user_Activity";
    $roomsPath = "../db/rooms";

    //get all rooms
    $allRooms = glob($roomsPath . "/*.txt");
    $roomNames = array_map(function($file){
        return basename($file, ".txt");
    }, $allRooms);

    //get user Activity                                                     
    $userActivityFile = $userActivityPath . "/" . $_SESSION["username"] . "_last_read.txt";
    $userActivityTime = [];
    // error_log("file activitiy: ".$userActivityFile);
    if(file_exists($userActivityFile)){
        $lines = file($userActivityFile);
        foreach($lines as $line){
            $parts = explode("|", $line);
            $userActivityTime[$parts[0]] = $parts[1];
        }
    }
    //process  room
    $unreadCount = 0;
    $lastReadTime = 0;
    foreach($roomNames as $room){
        if($room == $_GET["room"]){
            $roomFile = $roomsPath . "/" . $room .".txt";
            if(file_exists($roomFile)){
                $messages = file($roomFile);
                foreach($userActivityTime as $key => $value ){
                    if($key == $room){
                        $lastReadTime = $value;
                    }
                }
                
                foreach($messages as $message){
                    $parts = explode("|", $message);
                    $date = DateTime::createFromFormat("d/m/y H:i", trim($parts[2]));
                    if($date && $date->getTimestamp() > $lastReadTime){
                        $unreadCount++;
                    }
                }
            }else{
                error_log("file[" . $roomFile. "]does not exist");
            }
        }
    }
    error_log($unreadCount);  
    if($unreadCount > 0){
        echo $unreadCount;   
    }else{
        if($_SESSION["username"] !== "guest"){
            echo "0";
        }   
    }
    exit;
}
?>