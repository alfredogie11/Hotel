<?php 
session_start();
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$request = $_POST["request"];
$cin = $_POST["cin"];
$cout = $_POST["cout"];
$startEnd = $_POST["start-end"];//start-end



$con = mysqli_connect("localhost","root","","hotel");

$room_id = $_SESSION["room_id"];

$finalCinValue = $cin. " " .$startEnd.":00";
$finalCoutValue = $cout . " " .$startEnd.":00";

$res = mysqli_query($con, "INSERT INTO roombook VALUES ( DEFAULT , $room_id, '$fname', '$lname', '$email' , '$phone', '$request','$finalCinValue', '$finalCoutValue', 0  )");
if($res){
    header("location: Reservation.php");
    $_SESSION["successBooked"] = true;
}



?>