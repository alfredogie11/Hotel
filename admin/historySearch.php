<?php
 $con = mysqli_connect("localhost", "root", "", "hotel");
 $que1 = mysqli_query($con, "SELECT * FROM roombook where stat = -1 ORDER BY cin");

$rs = [];

while ($row = mysqli_fetch_assoc($que1)) {
    $queGetRoomName = mysqli_query($con, "SELECT * FROM room WHERE id = " . $row["room_id"]);
    if ($res1 = mysqli_fetch_assoc($queGetRoomName)) {
        $row["type"] = $res1["type"];
        
        $row["cin"] = date_format(date_create($row["cin"]), "M d, Y h:i a");
        $row["cout"] = date_format(date_create($row["cout"]), "M d, Y h:i a");
    }
    array_push($rs, $row);
}

echo json_encode($rs);
?>