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
                <a class="navbar-brand" >
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
                    <!-- 
                    <li>
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

                            <small>Booked Logs</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <!-- dagdag -->
                    <div class="col-md-6"> <input type="text" class="form-control" id="search-input"
                            placeholder="Search" />
                    </div>
                    <div class="col-md-3"> <button id="search-btn" class="btn btn-primary" type="button"
                            onclick="loadDoc()">Search</button> &nbsp;

                        <a href="history.php"><button class="btn btn-info" type="button">REFRESH</button></a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <script>
                    function loadDoc(searchVal) {

                        const xhttp = new XMLHttpRequest();
                        xhttp.onload = function () {
                            // document.getElementById("demo").innerHTML = this.responseText;

                            var response = JSON.parse(this.responseText);
                            console.log(response)

                            document.getElementById("resultbody").innerHTML = ""
                            response.forEach(row => {

                                var concatRow = Object.values(row).join(" ");
                                //alert(concatRow)

                                if (concatRow.toLocaleLowerCase().includes(searchVal.toLocaleLowerCase())) {


                                    if (row.extended_cout != null) {
                                        row.cout = row.extended_cout
                                       // alert(row.extended_cout)
                                    }
                                    document.getElementById("resultbody").innerHTML +=
                                        `
                                        <tr> 
                                        <th scope="row">${row.room_number}</th>
                                            <td> ${row.type}  </td>
                                            <td> ${row.FName}  ${row.LName}</td>
                                            <td> ${row.Email}  </td>
                                            <td> ${row.Phone}  </td>
                                            <td> ${row.cout}  </td>
                                            <th scope="col">
                                            <a>
                                                <button  id='${row.id}' type="button" class="btn btn-primary view-modal"  data-toggle="modal" data-target="#exampleModalCenter">
                                                        View All Info
                                                </button>
                                            </a>
                                        </th>
                                        </tr>
                                        `


                                   setloadInfo()
                                }
                                else {
                                    //alert()
                                }


                            });

                        }
                        xhttp.open("GET", "historySearch.php", true);
                        xhttp.send();


                    }
                </script>
                <br><br>

                <p id="search-p" style="display: none;">Search Result for: <span id="search-txt"> </span></p>
                <script>

                    document.getElementById("search-btn").onclick = function () {



                        var searchVal = document.getElementById("search-input").value
                        if (searchVal.trim() == "") {
                            document.getElementById("search-p").style.display = "none"
                            document.getElementById("search-input").value = ""
                            location.href = "history.php"
                        }
                        else {
                            document.getElementById("search-p").style.display = "block"
                            document.getElementById("search-txt").innerHTML = searchVal
                            loadDoc(searchVal);
                        }


                    }


                </script>
                <!-- end dagdag -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Room Number</th>
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <!-- <th scope="col">No. of Days</th>
                            <th scope="col">Check in</th> -->
                            <th scope="col">Date Checked out</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="resultbody">


                        <?php
                        $con = mysqli_connect("localhost", "root", "", "hotel");
                        $que1 = mysqli_query($con, "SELECT * FROM roombook where stat = -1 ORDER BY cin");

                        $resultSet = [];


                        //get current date and time in ff. format yyyy-MM-dd HH:mm:ss
                        date_default_timezone_set('Asia/Manila');
                        $date = date('Y-m-d H:i:s');

                        while ($result = mysqli_fetch_assoc($que1)) {


                            $checkInDateTime = date_create($result["cin"], timezone_open('Asia/Manila'));


                            //check if checkout time finished
                            $checkOutDateTime = date_create($result["cout"], timezone_open('Asia/Manila'));
                            $currentDateTime = date_create($date, timezone_open('Asia/Manila'));

                            $result["days"] = date_diff($checkInDateTime, $checkOutDateTime)->format("%d");

                            // if( $checkOutDateTime < $currentDateTime ){
                            //     mysqli_query($con, "UPDATE roombook SET stat = -1 WHERE id =".$result["id"]);
                            //     continue;
                            // }
                        
                            $room_name = "";
                            $queGetRoomName = mysqli_query($con, "SELECT * FROM room WHERE id = " . $result["room_id"]);
                            if ($res1 = mysqli_fetch_assoc($queGetRoomName)) {
                                $room_name = $res1["type"];
                            }

                            $result["room_type"] = $room_name;
                            array_push($resultSet, $result);

                        }


                        foreach ($resultSet as $result_) {


                            if (!is_null($result_["extended_cout"])) {
                                $result_["cout"] = $result_["extended_cout"];
                            }
                            if (!is_null($result_["early_cout"])) {
                                $result_["cout"] = $result_["early_cout"];
                            }

                            echo '
                                        <tr>
                                        <th scope="row">' . $result_["room_number"] . '</th>
                                        <th scope="row">' . $result_["room_type"] . '</th>
                                        <td>' . $result_["FName"] . ' ' . $result_["LName"] . '</td>
                                        <td>' . $result_["Email"] . '</td>
                                        <td>' . $result_["Phone"] . '</td>
                                       
                                        <td>' . date_format(date_create($result_["cout"]), "M d, Y h:i a") . '</td>

                                        
                                       
                                        <th scope="col">
                                        <a>
                                        <button  id="'.$result_["id"].'" type="button" class="btn btn-primary view-modal"  data-toggle="modal" data-target="#exampleModalCenter">
                                        View All Info
                                </button>
                                        </a>
                                        </th>
                                    </tr>
                                        ';

                            // <td>' . $result_["days"] . '</td>
                            // <td>' . date_format(date_create($result_["cin"]), "M d, Y h:i a")  . '</td>
                        }

                        if (mysqli_num_rows($que1) == 0) {
                            echo '<tr><td colspan="6">NO RESULT</td></tr>';
                        }
                        ?>

                        <script>
                           function setloadInfo(){
                            for (const element of document.getElementsByClassName("view-modal")) {
                                        element.addEventListener('click', function () {

                                            //alert(element.getAttribute("id"))
                                            const xhttp2 = new XMLHttpRequest();
                                            xhttp2.onload = function () {
                                                var responseInfo = JSON.parse(this.responseText);
                                                console.log(responseInfo );
                                                document.getElementById("roomNM").innerHTML = responseInfo[0].room_number
                                                document.getElementById("titleModal").innerHTML = responseInfo[0].type
                                                document.getElementById("nameM").innerHTML = responseInfo[0].FName + " " + responseInfo[0].LName
                                                document.getElementById("emailM").innerHTML = responseInfo[0].Email
                                                document.getElementById("phoneM").innerHTML = responseInfo[0].Phone
                                                document.getElementById("typeM").innerHTML = responseInfo[0].type
                                                document.getElementById("requestM").innerHTML = responseInfo[0].Special_Request
                                                document.getElementById("cinM").innerHTML = responseInfo[0].cin
                                                document.getElementById("coutM").innerHTML = responseInfo[0].cout
                                                document.getElementById("coutMEx").innerHTML = responseInfo[0].extended_cout

                                                if(responseInfo[0].early_cout==null){
                                                    document.getElementById("coutMEr").innerHTML = "NO"
                                                }
                                                else{
                                                    document.getElementById("coutMEr").innerHTML = "YES / " + responseInfo[0].early_cout
                                                }
                                                
                                               // document.getElementById("coutMEr").innerHTML = responseInfo[0].early_cout
                                                document.getElementById("days").innerHTML = responseInfo[0].days
                                                document.getElementById("priceM").innerHTML = "&#8369;" +responseInfo[0].price
                                                document.getElementById("total").innerHTML = "&#8369;" +responseInfo[0].total
                                                
                                            }
                                            xhttp2.open("GET", "historyViewBack.php?id="+element.getAttribute("id"), true);
                                            xhttp2.send();
                                        })
                                    }
                           }
                           setloadInfo();
                        </script>



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

    <?php
    require("./historymodal.html")
        ?>
</body>

</html>