<?php
function saveActivityUser($room , $filePath){
    // save into the file path , the room he is in and the time in unix
    // 1. find the room line inside the file, 
    $lines = file($filePath, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    $helpArray = [];
    $roomsInFile = [];
    foreach($lines as $line){
        $parts = explode("|", $line);
        $lineRoom = $parts[0];
        $roomsInFile[] = $parts[0];
        if($room === $lineRoom){
            $parts[1] = time();
        }
        $newLine = implode("|", $parts);
        $helpArray[] = $newLine;
    }
    if(!in_array($room, $roomsInFile)){
        $parts = [$room, time()];
        $newLine = implode("|", $parts);
        $helpArray[] = $newLine;
    }
    file_put_contents($filePath, implode("\n",  $helpArray), LOCK_EX);
}


?>