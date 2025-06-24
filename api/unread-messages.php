<?php

function findRoomFile($room) {
    $locations = [
        "../db/rooms/" . $room . ".txt",
        "../db/private_rooms/" . $room . ".txt"
    ];
    
    foreach ($locations as $file) {
        if (file_exists($file)) {
            return $file;
        }
    }
    return null; // File not found in either location
}

?>



<?php 
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    // error_log($_GET["room"]." - [".$_SESSION["username"]."]");
    $userActivityPath = "../db/user_Activity";
    $pathsArray = [
        "../db/rooms",
        "../db/private_rooms"
    ];
    $roomNames = [];
  
    //get all rooms
    foreach($pathsArray as $roomsPath){
        $currentRooms = [];
        $allRooms = glob($roomsPath . "/*.txt");
        $currentRooms += array_map(function($file){
            return basename($file, ".txt");
        }, $allRooms);

        $roomNames = array_merge($roomNames, $currentRooms);
    }

    

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
            $roomFile = findRoomFile($room);
            if ($roomFile === null) {
                error_log("Room file not found!");
            }
            // error_log($roomFile);
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
    // error_log($unreadCount);  
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