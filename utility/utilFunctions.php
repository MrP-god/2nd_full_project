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

?>