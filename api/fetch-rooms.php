<?php
    session_start();
    include "../utility/utilFunctions.php";

    

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $publicRoomsPath = "../db/rooms";
        $privateRoomsPath = "../db/private_rooms";

        if(isset($_SESSION["username"])){

            $publicRoomsNames = getNameFiles($publicRoomsPath);
            $privateRoomsNames = getNameFiles($privateRoomsPath);
            $rooms = [];
            $section = "private";

            ob_start();
            include "../templates/divider-rooms-template.php";
            $rooms[] = ob_get_clean();

            foreach($privateRoomsNames as $privateRooms){
                $parts = explode("_", $privateRooms);
                $reciver = ""; // room name to display dm so the other user nickname
                if($parts[1] == $_SESSION["username"] || $parts[2] == $_SESSION["username"]){
                    $nameRoom = $privateRooms; // room for value in form

                    //assign names 
                    if($_SESSION["username"] == $parts[1]) {
                        $reciver = $parts[2];
                    }elseif($_SESSION["username"] == $parts[2]){
                        $reciver = $parts[1];
                    }
                    $nameChat = $reciver;
                    ob_start();
                    include "../templates/rooms-template.php";
                    $rooms[] = ob_get_clean();
                }   
            }
            $section = "public";
            ob_start();
            include "../templates/divider-rooms-template.php";
            $rooms[] = ob_get_clean();

            foreach($publicRoomsNames as $publicRoom){
                // echo $publicRoom."<br>";
                $nameChat = $publicRoom;
                $nameRoom = $publicRoom;
                ob_start();
                include "../templates/rooms-template.php";
                $rooms[] = ob_get_clean();
            }
        }
        echo implode("", $rooms);
        exit;
    }



?>