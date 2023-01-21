<?php 
session_start();

$reserved_room_id = $_SESSION["reserved_room_id"];

$_POST["cin"];
$_POST["cout"];
///confirmCbx
$_POST["confirmCbx"];
$_POST["time"];

$con = mysqli_connect("localhost","root","","hotel");

if($_POST["confirmCbx"]== "Decline"){
  $delQuery = mysqli_query($con, "DELETE FROM roombook WHERE id =  ".$reserved_room_id);
  header("location: reservedRoom.php");
}
else{
    $updateEndDateQue = mysqli_query($con, "UPDATE roombook SET  invoice_id='".$reserved_room_id."-".generateRandomString()."-".date('Ym')."',  cin = '".$_POST["cin"]." ".$_POST["time"].":00'  , cout =  '".$_POST["cout"]." ".$_POST["time"].":00' , stat = 1  WHERE id =  ".$reserved_room_id);
    header("location: bookedRoom.php");
}


function generateRandomString($length = 8) {
  $characters = '0123456789';
  //abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

?>