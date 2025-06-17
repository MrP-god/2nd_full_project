<?php
include_once "../utility/utilFunctions.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    if(!empty($_SESSION["logged"]) && !empty($_SESSION["username"])){
        saveLastActivityUser($_SESSION["username"],"../db/users.txt");
    }
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>