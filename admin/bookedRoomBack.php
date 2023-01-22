<?php
session_start();

$_SESSION["booked_room_id"] = $_GET["id"];


echo $_SESSION["booked_room_id"] ;

header("location: viewBookedRoom.php", true);
?>