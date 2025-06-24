<?php
    function getUserColor($author) {
        // Use hash of username to always get same color for same user
        $hash = md5($author);
        return sprintf('#%06X', hexdec(substr($hash, 0, 6)) % 0x400000 + 0x400000);
    }
    function getBgColor($author) {
        // Tailwind color options (excluding neutral colors for better variety)
        $colors = [
            'red', 'orange', 'amber', 'yellow', 'lime', 'green', 
            'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 
            'violet', 'purple', 'fuchsia', 'pink', 'rose'
        ];
        
        // Weight options (300-900 in steps of 100)
        $weights = [100, 200, 300];
        
        // Use hash of username to always get same color for same user
        $hash = md5($author);
        
        // Convert first 8 characters of hash to integer for better distribution
        $hashInt = hexdec(substr($hash, 0, 8));
        
        // Select color and weight based on hash
        $colorIndex = $hashInt % count($colors);
        $weightIndex = ($hashInt >> 8) % count($weights);
        
        $color = $colors[$colorIndex];
        $weight = $weights[$weightIndex];
        
        return "bg-{$color}-{$weight}";
    }

    function getProfileColor($author){
        $hash = md5($author);

    }

    function replaceLinks($text){
        $pattern = '/(https?:\/\/[^\s]+)/';
        $replacement = '<a href="$1" target="_blank">$1</a>';
        $newText = preg_replace($pattern, $replacement, $text);
        return $newText;
    }

    // return the array with the lines of the txt.file given the path
    function getFileArray($filePath){
        if(file_exists($filePath)){
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            return $lines;
        } 
    }

    // $divider is the character used to divid line data inside txt
    function checkUsernameExists($users, $targetUsername) {
        foreach($users as $user) {
            $parts = explode("|", $user);
            $username = $parts[0] ?? ''; // Only care about first part
            
            if($targetUsername == $username) {
                return false; // Username exists
            }
        }
        return true; // Username is new
    }

    // TODO: but as last feature after fixed the text with session
    function saveLastActivityUser($username, $filePath){
        $users = file($filePath, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
        $array = [];
        foreach($users as $user){
            $parts = explode("|", $user);
            $user = $parts[0];

            if($username == $user){//enters if username exist to prevent guest name
                $parts[3] = time();   
            } 
            $newLine = implode("|", $parts);
            $array[] = $newLine;
        }
        file_put_contents($filePath, implode("\n", $array), LOCK_EX);
    }

    function checkFilePath($roomName){

        $privateFile = "../db/private_rooms/{$roomName}.txt";
        $publicFile = "../db/rooms/{$roomName}.txt";

        if(file_exists($privateFile)){
            $filePath = $privateFile;
        }elseif(file_exists($publicFile)){
            $filePath = $publicFile;
        }else{
            $filePath = "";
        }
        return $filePath;
    }

    function getNameFiles($parentFolder){
        $roomsFiles = glob($parentFolder . "/*.txt");
        return $cleanRooms = array_map(function($file){
            return basename($file, ".txt");
        }, $roomsFiles);
    }
?>