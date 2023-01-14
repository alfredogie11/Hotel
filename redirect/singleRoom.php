<?php
session_start();

$_SESSION["room_id"] = $_GET["id"];
// echo $_SESSION["room_id"];

$con = mysqli_connect("localhost", "root", "", "hotel");
$res = mysqli_query($con, "SELECT * FROM room WHERE id =  " . $_SESSION["room_id"] . " ");

$room_info;

if ($row = mysqli_fetch_assoc($res)) {
    $room_info = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Room</title>

    <!-- Bootstrap Styles-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="../css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
        .upper-part{
            margin: 3rem;
        }
        .room-info h3 {
          padding-bottom: 1rem;
        }
    </style>

</head>

<body>
    <div class="row">
        <div class="col-md-12" style=" background-color: #428BCA;">
            <h1 class="" style="color: white;text-align: center;">
                Reservation Page
            </h1>
        </div>
    </div>


    <div class="row upper-part" style="display: flex; justify-content:center">
        <div class="col-md-6 col-sm-12">
            <img  src="../images/room_rates/singleroom.jpg" alt=" " class="img-responsive img-main" />
        </div>
        <div class="col-md-6 col-sm-12 room-info">
            <h3>Type: <span>
                    <?php echo $room_info["type"] ?>
                </span> </h3>
            <h3>Price:  <span>&#8369;   <?php echo $room_info["price"] ?></span></h3>
        </div>
    </div>
</body>

</html>