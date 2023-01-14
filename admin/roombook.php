<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 

<?php
		if(!isset($_GET["rid"]))
		{
				
			 header("location:index.php");
		}
		else {
				$curdate=date("Y/m/d");
				include ('db.php');
				$id = $_GET['rid'];
				
				
				$sql ="Select * from roombook where id = '$id'";
				$re = mysqli_query($con,$sql);
				while($row=mysqli_fetch_array($re))
				{
					$title = $row['Title'];
					$fname = $row['FName'];
					$lname = $row['LName'];
					$email = $row['Email'];
					$nat = $row['National'];
					$country = $row['Country'];
					$Phone = $row['Phone'];
					$troom = $row['TRoom'];
					$nroom = $row['NRoom'];
					$bed = $row['Bed'];
					$non = $row['NRoom'];
					$meal = $row['Meal'];
					$cin = $row['cin'];
					$cout = $row['cout'];
					$sta = $row['stat'];
					$days = $row['nodays'];
					
				
				
				}
					
					
				
		
	}
		
		
		
			?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator	</title>
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
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
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

                    <li>
                        <a  href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                    <!-- <li>
                        <a href="messages.php"><i class="fa fa-desktop"></i> News Letters</a>
                    </li> -->
					<li>
                        <a class="active-menu" href="roombook.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>
                    <li>
                        <a href="payment.php"><i class="fa fa-qrcode"></i> Payment</a>
                    </li>
					<!-- <li>
                        <a  href="profit.php"><i class="fa fa-qrcode"></i> Profit</a>
                    </li> -->
                    
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
                            Room Booking<small>	<?php echo  $curdate; ?> </small>
                        </h1>
                    </div>
					
					
					<div class="col-md-8 col-sm-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           Booking Confirmation
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
                                            <th><?php echo $title.$fname.$lname; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Email</th>
                                            <th><?php echo $email; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Nationality </th>
                                            <th><?php echo $nat; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Country </th>
                                            <th><?php echo $country;  ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Phone No </th>
                                            <th><?php echo $Phone; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Type Of the Room </th>
                                            <th><?php echo $troom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>No Of the Room </th>
                                            <th><?php echo $nroom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Extras </th>
                                            <th><?php echo $meal; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Bedding </th>
                                            <th><?php echo $bed; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Check-in Date </th>
                                            <th><?php echo $cin; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Check-out Date</th>
                                            <th><?php echo $cout; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>No of days</th>
                                            <th><?php echo $days; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Status Level</th>
                                            <th><?php echo $sta; ?></th>
                                            
                                        </tr>
                                   
                                  
                                        
                                        
                                    
                                </table>
                            </div>
                        
					
							
                        </div>
                        <div class="panel-footer">
                            <form method="post">
										<div class="form-group">
														<label>Select the Confirmation</label>
														<select name="conf"class="form-control">
															<option value selected>	</option>
															<option value="Confirm">Confirm</option>
															
															
														</select>
										 </div>
							<input type="submit" name="co" value="Confirm" class="btn btn-success">
							
							</form>
                        </div>
                    </div>
					</div>
					
					<?php
						$rsql ="select * from room";
						$rre= mysqli_query($con,$rsql);
						$r =0 ;
						// $sc =0;
						// $gh = 0;
						// $sr = 0;
						// $dr = 0;

						//new var
						$sr = 0; //single room
						$twr = 0; // twin room
						$trr = 0; //triple room
						$sur = 0;// suite room
						$pr = 0;// penthouse room
						$ah = 0; //atis hall
						$rh = 0;// rambutan hall
						$bh = 0; // bayabas hall
						while($rrow=mysqli_fetch_array($rre))
						{
							$r = $r + 1;
							$s = $rrow['type'];
							$p = $rrow['place'];
							if($s=="Single Room" )
							{
								$sr = $sr+ 1;
							}
							if($s=="Twin Room")
							{
								$twr = $twr + 1;
							}
							if($s=="Triple Room" )
							{
								$trr = $trr + 1;
							}
							if($s=="Suite Room" )
							{
								$sur = $sur + 1;
							}
							if($s=="Penthouse Room" )
							{
								$pr = $pr + 1;
							}
							
							if($s=="Atis Hall" )
							{
								$ah = $ah + 1;
							}
							if($s=="Rambutan Hall" )
							{
								$rh = $rh + 1;
							}
							if($s=="Bayabas Hall" )
							{
								$bh = $bh + 1;
							}
							
							
						
						}
						?>
						
						<?php
						$csql ="select * from payment";
						$cre= mysqli_query($con,$csql);
						$cr =0 ;
						// $csc =0;
						// $cgh = 0;
						// $csr = 0;
						// $cdr = 0;

						//new var
						$csr = 0; //single room
						$ctwr = 0; // twin room
						$ctrr = 0; //triple room
						$csur = 0;// suite room
						$cpr = 0;// penthouse room
						$cah = 0; //atis hall
						$crh = 0;// rambutan hall
						$cbh = 0; // bayabas hall

						while($crow=mysqli_fetch_array($cre))
						{
							

							$cr = $cr + 1;
							$cs = $crow['troom'];
							if($cs=="Single Room" )
							{
								$csr = $csr+ 1;
							}
							if($cs=="Twin Room")
							{
								$ctwr = $ctwr + 1;
							}
							if($cs=="Triple Room" )
							{
								$ctrr = $ctrr + 1;
							}
							if($cs=="Suite Room" )
							{
								$csur = $csur + 1;
							}
							if($cs=="Penthouse Room" )
							{
								$cpr = $cpr + 1;
							}
							
							if($cs=="Atis Hall" )
							{
								$cah = $cah + 1;
							}
							if($cs=="Rambutan Hall" )
							{
								$crh = $crh + 1;
							}
							if($cs=="Bayabas Hall" )
							{
								$cbh = $cbh + 1;
							}
							
						
						}
				
					?>
					<div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Available Room Details
                        </div>
                        <div class="panel-body">
						<table width="200px">
							
							<tr>
								<td><b>Single Room	 </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php  
									
									$f1 =$sr - $csr;
									if($f1 <=0 )
									{	$f1 = "NO";
										echo $f1;
									}
									else{
											echo $f1;
									}
								
								
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Twin Room</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								$f2 =  $twr  - $ctwr ;
								if($f2 <=0 )
									{	$f2 = "NO";
										echo $f2;
									}
									else{
											echo $f2;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Triple Room</b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
								$f3 =$trr  - $ctrr ;
								if($f3 <=0 )
									{	$f3 = "NO";
										echo $f3;
									}
									else{
											echo $f3;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Suite Room</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f4 =$sur - $csur; 
								if($f4 <=0 )
									{	$f4 = "NO";
										echo $f4;
									}
									else{
											echo $f4;
									}
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Penthouse Room</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f5 =$pr  - $cpr ; 
								if($f5 <=0 )
									{	$f5 = "NO";
										echo $f5;
									}
									else{
											echo $f5;
									}
								?> </button></td> 
							</tr>

							<tr>
								<td><b>Atis Hall</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f6 =$ah  - $cah ; 
								if($f6 <=0 )
									{	$f6 = "NO";
										echo $f6;
									}
									else{
											echo $f6;
									}
								?> </button></td> 
							</tr>

							<tr>
								<td><b>Rambutan Hall</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f7 =$rh - $crh  ; 
								if($f7 <=0 )
									{	$f7 = "NO";
										echo $f7;
									}
									else{
											echo $f7;
									}
								?> </button></td> 
							</tr>

							<tr>
								<td><b>Bayabas Hall</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f8 =$bh - $cbh  ; 
								// echo "<script>alert(".$cbh.")</script>";
								if($f8 <=0 )
									{	$f8 = "NO";
										echo $f8;
									}
									else{
											echo $f8;
									}
								?> </button></td> 
							</tr>

							
							



							<tr>
								<td><b>Total Rooms	</b> </td>
								<td> <button type="button" class="btn btn-danger btn-circle"><?php 
								
								$f9 =$r-$cr; 
								if($f9 <=0 )
									{	$f9 = "NO";
										echo $f9;
									}
									else{
											echo $f9;
									}
								 ?> </button></td> 
							</tr>
						</table>
						
						
						
                        
						
						</div>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
					</div>
                </div>
                <!-- /. ROW  -->
				
                </div>
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

<?php
						if(isset($_POST['co']))
						{	
							$st = $_POST['conf'];
							
							 
							
							if($st=="Confirm")
							{
									$urb = "UPDATE `roombook` SET `stat`='$st' WHERE id = '$id'";
									
								if($f1=="NO" && $troom == "Single Room")
								{
									echo "<script type='text/javascript'> alert('Sorry! Not Available Single Room ')</script>";
								}
								else if($f2 =="NO" && $troom == "Twin Room")
									{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Twin Room')</script>";
										
									}
									else if ($f3 == "NO" && $troom == "Triple Room")
									{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Triple Room')</script>";
									}
										else if($f4=="NO" && $troom == "Suite Room")
										{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Suite Room')</script>";
										}

										else if($f5=="NO" && $troom == "Penthouse Room")
										{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Penthouse Room')</script>";
										}

										else if($f6=="NO" && $troom == "Atis Hall")
										{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Atis Hall')</script>";
										}
										else if($f7=="NO" && $troom == "Rambutan Hall")
										{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Rambutan Hall')</script>";
										}
										else if($f8=="NO" && $troom == "Bayabas Hall")
										{
										echo "<script type='text/javascript'> alert('Sorry! Not Available Bayabas Hall')</script>";
										}
	
										else if( mysqli_query($con,$urb))
											{	
												//echo "<script type='text/javascript'> alert('Guest Room booking is Confirm')</script>";
												//echo "<script type='text/javascript'> window.location='home.php'</script>";
												 $type_of_room = 0;       
														if($troom=="Single Room")
														{
															$type_of_room = 2500;
														
														}
														else if($troom=="Twin Room")
														{
															$type_of_room = 3000;
														}
														else if($troom=="Triple Room")
														{
															$type_of_room = 3500;
														}
														else if($troom=="Suite Room")
														{
															$type_of_room = 4000;
														}//Penthouse Room
														else if($troom=="Penthouse Room")
														{
															$type_of_room = 10000;
														}

														else if($troom=="Atis Hall")
														{
															$type_of_room = 20000;
														}
														else if($troom=="Rambutan Hall")
														{
															$type_of_room = 18000;
														}
														else if($troom=="Bayabas Hall")
														{
															$type_of_room = 6000;
														}
														
														
														
														if($bed=="Single")
														{
															$type_of_bed = $type_of_room * 1/100;
														}
														else if($bed=="Double")
														{
															$type_of_bed = $type_of_room * 2/100;
														}
														else if($bed=="Triple")
														{
															$type_of_bed = $type_of_room * 3/100;
														}
														else if($bed=="Quad")
														{
															$type_of_bed = $type_of_room * 4/100;
														}
														else if($bed=="None")
														{
															$type_of_bed = $type_of_room * 0/100;
														}
														else if($bed=="Default")
														{
															$type_of_bed = $type_of_room * 1/100;
														}
														
														
														if($meal=="Extra Pillow")
														{
															// $type_of_meal=$type_of_bed * 2;
															$type_of_meal= 55;
														}else if($meal=="Extra Blanket")
														{
															// $type_of_meal=$type_of_bed * 3;
															$type_of_meal=100;
														
														}
														else if($meal=="None")
														{
															$type_of_meal=0;
														
														}
														
														
														$ttot = $type_of_room * $days * $nroom;
														$mepr = $type_of_meal * $days;
														$btot = $type_of_bed *$days;
														
														$fintot = $ttot + $mepr + $btot ;
															
															//echo "<script type='text/javascript'> alert('$count_date')</script>";
														$psql = "INSERT INTO `payment`(`id`, `title`, `fname`, `lname`, `troom`, `tbed`, `nroom`, `cin`, `cout`, `ttot`,`meal`, `mepr`, `btot`,`fintot`,`noofdays`) VALUES ('$id','$title','$fname','$lname','$troom','$bed','$nroom','$cin','$cout','$ttot','$meal','$mepr','$btot','$fintot','$days')";
														
														if(mysqli_query($con,$psql))
														{	$notfree="NotFree";

															$oneRes = "SELECT * FROM `room` where type='$troom' AND `place` = 'Free' ";	
															$queOneRes = mysqli_query($con, $oneRes);
																$idToUsed;
															if($resultOneRes = mysqli_fetch_assoc($queOneRes)){
																$idToUsed = $resultOneRes["id"];
															}
															


															$rpsql = "UPDATE `room` SET `place`='$notfree',`cusid`='$id' where `id` = $idToUsed ";
															if(mysqli_query($con,$rpsql))
															{
															echo "<script type='text/javascript'> alert('Booking Confirm')</script>";
															echo "<script type='text/javascript'> window.location='roombook.php'</script>";
															}
															
															
														}
												
											}
									
                                        
							}	
					
						}
					
									
									
							
						?>