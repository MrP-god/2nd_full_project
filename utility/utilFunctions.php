<?php
    function getUserColor($author) {
        // Use hash of username to always get same color for same user
        $hash = md5($author);
        return sprintf('#%06X', hexdec(substr($hash, 0, 6)) % 0x400000 + 0x400000);
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

?>