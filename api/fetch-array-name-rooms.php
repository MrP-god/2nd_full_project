<?php
    include "../utility/utilFunctions.php";
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $publicRoomsPath = "../db/rooms";
        $privateRoomsPath = "../db/private_rooms";
        $publicRoomsNames = getNameFiles($publicRoomsPath);
        $privateRoomsNames = getNameFiles($privateRoomsPath);
        $allAvailableRooms = array_merge($publicRoomsNames, $privateRoomsNames);
        
        echo json_encode($allAvailableRooms);
        exit;
    }

?>