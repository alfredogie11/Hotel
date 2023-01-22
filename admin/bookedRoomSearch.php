<?php
$con = mysqli_connect("localhost", "root", "", "hotel");
$que1 = mysqli_query($con, "SELECT * FROM roombook where stat = 1 ORDER BY cin");

$rs = [];

while ($row = mysqli_fetch_assoc($que1)) {


    $checkInDateTime =  new DateTime(date('Y-m-d', strtotime($row["cin"])));
    $checkOutDateTime =  new DateTime(date('Y-m-d', strtotime($row["cout"])));
    
    if (!is_null($row["extended_cout"])) {
        $checkOutDateTime = new DateTime(date('Y-m-d', strtotime($row["extended_cout"])));
    }
    //$checkInDateTime = date_create($row["cin"], timezone_open('Asia/Manila'));

    $date = date('Y-m-d H:i:s');
    //check if checkout time finished
   // $checkOutDateTime = date_create($row["cout"], timezone_open('Asia/Manila'));
    $currentDateTime = date_create($date, timezone_open('Asia/Manila'));

    $row["days"] = date_diff($checkInDateTime, $checkOutDateTime)->format("%d");

    $queGetRoomName = mysqli_query($con, "SELECT * FROM room WHERE id = " . $row["room_id"]);
    if ($res1 = mysqli_fetch_assoc($queGetRoomName)) {
        $row["type"] = $res1["type"];

        

        $row["cin"] = date_format(date_create($row["cin"]), "M d, Y h:i a");
         $row["cout"] = date_format(date_create($row["cout"]), "M d, Y h:i a");

        //$row["cin"] = new DateTime(date('M d, Y h:i a', strtotime($row["cin"])));
       // $row["cout"] = new DateTime(date('M d, Y h:i a', strtotime($row["cout"])));


        if (!is_null($row["extended_cout"])) {
            $row["extended_cout"] = date_format(date_create($row["extended_cout"]), "M d, Y h:i a");
        }

    }
    array_push($rs, $row);
}

echo json_encode($rs);
?>