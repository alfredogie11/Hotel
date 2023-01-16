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
    <title>Administrator </title>
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
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
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
                        <a href="history.php"><i class="fa fa-folder"></i>Booked Logs</a>
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

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            
                        <small>Reserved Room</small>
                        </h1>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Reserved Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <!-- <th scope="col">Check in</th>
                            <th scope="col">Check out</th> -->
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            $con = mysqli_connect("localhost","root","","hotel");
                            $que1 = mysqli_query($con, "SELECT * FROM roombook where stat = 0 ORDER BY cin");

                            $resultSet = [];

                            while($result = mysqli_fetch_assoc($que1)){


                                    $room_name = "";
                                    $queGetRoomName = mysqli_query($con, "SELECT * FROM room WHERE id = ".$result["room_id"]);
                                    if($res1 = mysqli_fetch_assoc($queGetRoomName)){
                                        $room_name = $res1["type"];
                                    }

                                    $result["room_type"] = $room_name; 
                                    array_push($resultSet, $result);

                            }


                            foreach( $resultSet as $result_){
                                        echo '
                                        <tr>
                                        <th scope="row">'.$result_["room_type"].'</th>
                                        <td>'.$result_["FName"].' '.$result_["LName"].'</td>
                                        <td>'.$result_["Email"].'</td>
                                        <td>'.$result_["Phone"].'</td>
                                        <td>Not Confirm</td>
                                        
                                        <th scope="col">
                                        <a href="reservedRoomBack.php?id='.$result_["id"].'">
                                            <button type="button" class="btn btn-primary">
                                                    View
                                            </button>
                                        </a>
                                        </th>
                                    </tr>
                                        ';
                            }


                            if(mysqli_num_rows($que1)==0){
                                    echo '<tr><td colspan="6">NO RESULT</td></tr>';
                            }
                        ?>

                        

                      
    
                    </tbody>
                </table>



            </div>


            <!-- DEOMO-->
            <!-- <div class='panel-body'>
                <button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
                    Update
                </button>
                <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4 class='modal-title' id='myModalLabel'>Change the User name and Password</h4>
                            </div>
                            <form method='post>
                                        <div class=' modal-body'>
                                <div class='form-group'>
                                    <label>Change User name</label>
                                    <input name='usname' value='<?php echo $fname; ?>' class='form-control' placeholder='Enter User name'>
                                </div>
                        </div>
                        <div class='modal-body'>
                            <div class='form-group'>
                                <label>Change Password</label>
                                <input name='pasd' value='<?php echo $ps; ?>' class='form-control' placeholder='Enter Password'>
                            </div>
                        </div>

                        <div class='modal-footer'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>

                            <input type='submit' name='up' value='Update' class='btn btn-primary'>
                            </form>

                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!--DEMO END-->




        <!-- /. ROW  -->

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


</body>

</html>