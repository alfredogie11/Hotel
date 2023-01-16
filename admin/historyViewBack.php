<?php
 $con = mysqli_connect("localhost", "root", "", "hotel");
 $que1 = mysqli_query($con, "SELECT * FROM roombook where stat = -1 AND id = ".$_GET["id"]." ORDER BY cin");

$rs = [];

while ($row = mysqli_fetch_assoc($que1)) {
    $queGetRoomName = mysqli_query($con, "SELECT * FROM room WHERE id = " . $row["room_id"]);
    if ($res1 = mysqli_fetch_assoc($queGetRoomName)) {
        $row["type"] = $res1["type"];
        $row["price"] = $res1["price"];
    }
     $checkInDateTime = date_create($row["cin"], timezone_open('Asia/Manila'));
    $checkOutDateTime = date_create($row["cout"], timezone_open('Asia/Manila'));
    $row["days"] = $result["days"] = date_diff($checkInDateTime, $checkOutDateTime)->format("%d");

    $row["cin"] = date_format($checkInDateTime, "M d, Y h:i a");;
    $row["cout"] = date_format( $checkOutDateTime, "M d, Y h:i a");

    $row["total"] = intval($row["days"]) * floatval($row["price"]);

    array_push($rs, $row);
}

echo json_encode($rs);
?>