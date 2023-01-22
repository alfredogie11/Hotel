<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Reserved Info </title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">
                    <?php echo $_SESSION["user"]; ?>
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <!-- <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <!-- <li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li> -->

                    <li>
                        <a href="reservedRoom.php"><i class="fa fa-bar-chart-o"></i>Reserved Room</a>
                    </li>
                    <li>
                        <a href="bookedRoom.php"><i class="fa fa-qrcode"></i>Booked Room</a>
                    </li>

                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>




                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <?php
                $con = mysqli_connect("localhost", "root", "", "hotel");
                $que1 = mysqli_query($con, "SELECT * FROM roombook where id = " . $_SESSION["booked_room_id"]);

                $reserved_room_info = mysqli_fetch_assoc($que1);

               // $_SESSION["reserved_room_id"] = $reserved_room_info["room_id"];

                $que2 = mysqli_query($con, "SELECT * FROM room where id = " . $reserved_room_info["room_id"]);
                $current_room_info = mysqli_fetch_assoc($que2);

                if (!is_null( $reserved_room_info["extended_cout"])) {
                    $reserved_room_info["cout"] = $reserved_room_info["extended_cout"];
                }


                ?>


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            View Booked Room Info<small> </small>
                        </h1>
                    </div>


                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <p>In this page you can checkout or extend the scheduled booked room</p>
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>INFORMATION</th>

                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>
                                                <?php echo $reserved_room_info["FName"] . " " . $reserved_room_info["LName"] ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th>
                                                <?php echo $reserved_room_info["Email"]; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Phone </th>
                                            <th>
                                                <?php echo $reserved_room_info["Phone"]; ?>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th>Type Of the Room </th>
                                            <th>
                                                <?php echo $current_room_info["type"]; ?>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th>Request </th>
                                            <th>
                                                <?php
                                                if (trim($reserved_room_info["Special_Request"], " ") == "") {
                                                    echo "NONE";
                                                } else {
                                                    echo $reserved_room_info["Special_Request"];
                                                    ;
                                                }

                                                ?>
                                            </th>

                                        </tr>
                                        <form method="post" action="./viewBookedBack.php">
                                            <tr>
                                                <th>Check-in Date </th>
                                                <th><input id="cin" type="date" name="cin" readonly
                                                        value="<?php echo explode(" ", $reserved_room_info["cin"])[0]; ?>" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Check-out Date</th>
                                                <th contenteditable="true">
                                                    <input id="cout" type="date" name="cout"
                                                        value="<?php echo explode(" ", $reserved_room_info["cout"])[0]; ?>" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Check-out Time</th>
                                                <th contenteditable="true">
                                                    <input id="time" type="time" name="time"
                                                        value="<?php echo explode(" ", $reserved_room_info["cout"])[1]; ?>" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>No of days</th>
                                                <th id="days">
                                                    <?php
                                                    $from = date_create(strval($reserved_room_info["cin"]));
                                                    $to = date_create(strval($reserved_room_info["cout"]));

                                                    if (date_diff($from, $to)->format('%d') == "1") {
                                                        echo date_diff($from, $to)->format('%d day');
                                                        ;
                                                    } else {
                                                        echo date_diff($from, $to)->format('%d days');
                                                        ;
                                                    }


                                                    ?>
                                                </th>

                                            </tr>


                                            <tr>
                                                <th>Price Per Day</th>
                                                <th>
                                                    <?php echo "&#8369;" . $current_room_info["price"] ?>
                                                </th>

                                            </tr>

                                            <tr>
                                                <th>Total Price</th>
                                                <th id="total"><?php echo  "hehehee".intval(date_diff($from, $to)->format('%d'))  * 
                                                      floatval($current_room_info["price"])
                                                ?></th>

                                            </tr>


                                            <tr>
                                                <th>Status Level</th>
                                                <th>Already Booked</th>

                                            </tr>

<!--                                             
                                            <tr>
                                                <th>Select Room Number</th>
                                                <th contenteditable="true">
                                                    <select id="rnum" name="rnum">
                                                           
                                                            <?php
                                                            // $_SESSION["room_id"] = $reserved_room_info["room_id"];
                                                            // $queRoomNum = mysqli_query($con, "SELECT * FROM room_ids 
                                                            // WHERE room_id  = " .  $reserved_room_info["room_id"]." AND isAvailable = 0");   
                                                            // while($rowQueRnum = mysqli_fetch_assoc( $queRoomNum)){
                                                            //     echo ' <option selected>'.$rowQueRnum["room_number"].'</option>';
                                                            // }

                                                            ?>
                                                    </select>

                                                </th>

                                            </tr> -->


                                    </table>
                                </div>



                            </div>
                            <div class="panel-footer" style="display: flex; justify-content: center;">

                                <div class="form-group" style="display:  none;">
                                    <label>Select the Confirmation</label>
                                    <select name="confirmCbx" class="form-control">
                                        <option value="Decline"> Decline</option>
                                        <option value="Confirm" selected>Confirm</option>
                                    </select>
                                </div>
                                <input id="submit" type="button" name="confirm" value="Extend" class="btn btn-success">
                                <button id="submit2" type="submit" style="display: none;">
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <!-- Available Room Details -->
                            </div>
                            <div class="panel-body" style="display:  flex; justify-content: center;">
                                    <form method="post" action="*" >
                                                <button  style="padding: 3rem;"class="btn btn-primary">Check-out</button>
                                    </form>

                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                </div>



            </div>



        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <script>
        document.getElementById("cin").min = new Date().toISOString().split("T")[0];
        document.getElementById("cout").min = new Date().toISOString().split("T")[0];
        const dateChange = () => {




            //date script 

            var cinDate = new Date(document.getElementById("cin").value).getTime();
            var coutDate = new Date(document.getElementById("cout").value).getTime();


           

            var priceOfRoom = '<?php echo $current_room_info["price"] ?>';
            console.log(`Base Price of Room` + priceOfRoom);

            var origCout = "<?php echo $reserved_room_info["cout"] ?>".split(" ")[0]
            console.log("origdate" + document.getElementById("cout").value)


          

            //coutDate != cinDate && coutDate > cinDate
            if (new Date(document.getElementById("cout").value) > new Date(origCout) ) {
                console.log("Valid Input..... Continue to operation.........");

                var diff = coutDate - cinDate;

                var daydiff = diff / (1000 * 60 * 60 * 24);


                document.getElementById("days").innerHTML = daydiff


                var totalPrice = parseInt(daydiff) * parseFloat(priceOfRoom);
                console.log("Room Price" + totalPrice)

                //totalPrice
                document.getElementById("total").innerHTML = "&#8369; " + totalPrice
            } else {

                

                document.getElementById("total").innerHTML = "<?php echo  "&#8369; ".intval(date_diff($from, $to)->format('%d'))  * 
                                                      floatval($current_room_info["price"])?>";
                document.getElementById("cout").value = "<?php echo $reserved_room_info["cout"] ?>".split(" ")[0]
                //document.getElementById("cout").onchange()
            }

        }

        document.getElementById("cout").onchange = dateChange;
        document.getElementById("cin").onchange = dateChange;

        document.getElementById("cout").onchange()
    </script>


    <script>

        // document.getElementById("time").value = new Date().toTimeString().substring(0,5)
        console.log(new Date().toTimeString().substring(0,5))

        var submit = document.getElementById("submit");


        document.getElementById("cin").min = new Date().toISOString().split("T")[0];
        document.getElementById("cout").min = new Date().toISOString().split("T")[0];
        submit.onclick = function (event) {

            console.log(`cin` + document.getElementById("cin").value)
            console.log(`cout` + document.getElementById("cout").value)



            var cinDate = new Date(document.getElementById("cin").value).getTime();
            var coutDate = new Date(document.getElementById("cout").value).getTime();


            var origCout = "<?php echo $reserved_room_info["cout"] ?>".split(" ")[0]
            console.log("origdate" + document.getElementById("cout").value)

            //coutDate != cinDate && coutDate > cinDate
            if (new Date(document.getElementById("cout").value).getDate() == new Date(origCout).getDate() ) {
                alert("Extension date must be updated!");
                return
            } 
            // else if (coutDate < cinDate) {
            //     alert("Invalid Checkout date");
            //     return
            // }
            console.log("Continue to next code.......")


            // var cin = document.getElementById("cin").value
            // var cout = document.getElementById("cout").value
            //var startEnd = document.getElementById("start-end").value

    
         
             document.getElementById("submit2").click()
            

            //console.log(startEnd)



        }
    </script>



</body>

</html>