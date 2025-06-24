<?php
   session_start();

    $roomsFolder = "../db/private_rooms";
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        $user1 = $_GET["user1"]; //user 1 is alpabeticaly higher
        $user2 = $_GET["user2"];
        if($user1 !== "guest" && $user2 !== "guest"){
            if(strnatcmp($user1, $user2) > 0){
                $temp = $user1; //save lower user
                $user1 = $user2; //save higher user into first 
                $user2 = $temp; //save lower user into second
            }
            $dmRoomName = "dm_".$user1 ."_".$user2;

             //here i get the rooms name from rooms folder
             $roomsFiles = glob($roomsFolder . "/*.txt");
             $cleanRooms = array_map(function($file){
                 return basename($file, ".txt");
             }, $roomsFiles);

             //checking if dm room exist in db
             $roomExists = false;
             foreach($cleanRooms as $room){
                if($room == $dmRoomName){ 
                    $roomExists = true;
                }else{
                    $roomExists = false;
                }
             }
             
             
            if(!$roomExists){ //if rooms dont exit , create it
                file_put_contents( $roomsFolder ."/".$dmRoomName.".txt", "");
                }
             
             
        }
        header("Location: /chat.php?room={$dmRoomName}");
        exit;
    }

?>