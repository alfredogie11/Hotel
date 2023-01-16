<?php
session_start();

$_SESSION["reserved_room_id"] = $_GET["id"];


echo $_SESSION["reserved_room_id"] ;

header("location: viewReservedRoom.php", true);
?>