<?php
    function getUserColor($author) {
        // Use hash of username to always get same color for same user
        $hash = md5($author);
        return sprintf('#%06X', hexdec(substr($hash, 0, 6)) % 0x400000 + 0x400000);
    }

?>