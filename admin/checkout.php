<?php
session_start();
date_default_timezone_set('Asia/Manila');
$_SESSION["booked_room_id"];
echo $_SESSION["booked_room_id"];

$con = mysqli_connect("localhost", "root", "", "hotel");

$query = mysqli_query($con, "SELECT * FROM roombook WHERE id = " . $_SESSION["booked_room_id"]);

$result;

if ($row = mysqli_fetch_assoc($query)) {
    $result = $row;

    $firstdate = date_create(strval($result["cin"]));
    $lastDate;

    if (is_null($result['extended_cout'])) {
        $lastDate = new DateTime(date('Y-m-d h:i:s a', strtotime($result["cout"])));
    } else {
        $lastDate = new DateTime(date('Y-m-d h:i:s a', strtotime($result["extended_cout"])));
    }

    if (date('Y-m-d h:i:s a') < $lastDate) {
        echo date('Y-m-d h:i:s a'). "<";
        echo $lastDate->format('Y-m-d h:i:s a');
        mysqli_query($con, "UPDATE roombook SET stat = -1, early_cout = '".date('Y-m-d H:i:s')."' WHERE id = " . $result["id"]);
        //early checkout
    }
    else{
        mysqli_query($con, "UPDATE roombook SET stat = -1 WHERE id = " . $result["id"]);
    }

   //mysqli_query($con, "UPDATE roombook SET stat = -1 WHERE id = " . $result["id"]);
   mysqli_query($con, "UPDATE room_ids SET isAvailable = 0  WHERE room_number = " . $result["room_number"]);
}

echo $result["room_number"] . " " . $result["id"];
echo error_log(1);

header("location: history.php", true);
?>