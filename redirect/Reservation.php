<?php
session_start();

if (isset($_SESSION["successBooked"])) {
	header("location: prompt.php");
	unset($_SESSION["successBooked"]);
	exit();
}

$_SESSION["room_id"] = $_GET["id"];
// echo $_SESSION["room_id"];

$con = mysqli_connect("localhost", "root", "", "hotel");
$res = mysqli_query($con, "SELECT * FROM room WHERE id =  " . $_SESSION["room_id"] . " ");

$room_info;
$total_room;

if ($row = mysqli_fetch_assoc($res)) {
	$room_info = $row;
	$total_room = $room_info["total"];
}


$room_is_available = true;

$que2 = mysqli_query($con, "SELECT * FROM roombook WHERE room_id =  " . $_SESSION["room_id"] . " ");
$total_available_room = intval($total_room) - mysqli_num_rows($que2);

if ($total_available_room <= 0) {
	$room_is_available = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $room_info["type"] ?>
	</title>

	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords"
		content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- //for-mobile-apps -->
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/chocolat.css" type="text/css" media="screen">
	<link href="../css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" property="" />
	<link rel="stylesheet" href="../css/jquery-ui.css" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="../js/modernizr-2.6.2.min.js"></script>
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<!--//fonts-->
	</style>

</head>

<body>


	<!-- header -->
	<div>
	<div class="banner-top">
		<div class="clearfix"></div>
	</div>
	<div class="w3_navigation" style="padding-bottom: 4rem; margin-bottom: 3rem;">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					

					<h1> <a class="navbar-brand" href="index.php"> <span> <img src="../images/logo1.png" width="70" height="70"/> <img style="border-radius: 1rem;" src="../images/logo2.png" width="60" height="60"/> BARCIE INTERNATIONAL CENTER</span>
							<p class="logo_w3l_agile_caption" style="margin-left: 10rem;">La Consolacion University Philippines</p>
						</a></h1>
				</div>
				
			</nav>

		</div>
	</div>
	</div>
	
	<form style="display: block;" method="POST" action="./BookingReserveProcess.php">
		<div class="plans-section" id="rooms" style="padding: 0;">
			<div class="container" style="width: 90%;">
				<h3 class="title-w3-agileits " style="color:#fff;background: #3EA5CE;padding:1rem;width:100%">
					Reservation
				</h3>
				<div class="priceing-table-main">

					<style>
						.priceing-table-main {
							display: flex !important;
							flex-wrap: wrap !important;
							justify-content: center !important;
						}

						.price-gd-bottom {
							background: aliceblue;
						}

						.price-gd-bottom span {
							color: #6C6E89;
						}
					</style>


					<div class="col-md-6 price-grid">
						<div class="price-block agile">
							<div class="price-gd-top">
								<img src=" <?php echo $room_info["image"] ?>" alt=" " class="img-responsive" />
							</div>
							<div class="price-gd-bottom">
								<div class="price-gd-bottom">
									<h3> Price: &nbsp;<span> &#8369;
											<?php echo $room_info["price"]; ?>
										</span> </h3>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 price-grid">
						<div class="price-block agile">
							<div class="price-selet" style="text-align: left; margin-left: 1rem">
								<a href="../index.php">Back to Home</a>
							</div>



							<div class="price-gd-bottom">
								<h4> Type: &nbsp;<span>
										<?php echo $room_info["type"]; ?>
									</span> </h4>
							</div>
							<!-- <div class="price-gd-bottom">
								<h4> Price: &nbsp;<span> &#8369;
										<?php echo $room_info["price"]; ?>
									</span> </h4>
							</div> -->
							<div class="price-gd-bottom">
								<h4> Is Available ?: &nbsp;<span>
										<?php if ($room_is_available) {
											echo "Yes";
										} else {
											echo "No";
										}
										; ?>
									</span> </h4>
							</div>
							<div class="price-gd-bottom">
								<h4> Total Room Available: &nbsp;<span>
										<?php echo $total_available_room ?>
									</span></h4>
							</div>
							<div class="price-gd-bottom" style=" flex-direction: column;;justify-content: flex-start; margin: 0.5rem 0; border-top: 1px solid gainsboro;">
								<h5 style="text-align:left; margin-bottom: 1.5rem;">Description: </h5>
								<p style="text-align: justify;">
								<?php echo $room_info["description"]; ?>
								</p>
							</div>
						</div>
					</div>

					<style>
						.price-gd-bottom {
							display: flex;
							padding: 1rem;
							justify-content: center;
						}
					</style>




					<!--  -->
					<div class="col-md-6 price-grid add-info" style="margin: 2rem 0">
						<div class="price-block agile">
							<div class="panel panel-primary">
								<div class="panel-heading">
									PERSONAL INFORMATION
								</div>


								<div class="panel-body">
									<div class="form-group">
										<label>First Name*</label>
										<input id="fname" name="fname" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Last Name*</label>
										<input id="lname" name="lname" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Email Name*</label>
										<input id="email" name="email" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Phone Number*</label>
										<input id="phone" name="phone" class="form-control" required>
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>

					<!--  -->
					<div class="col-md-6 price-grid add-info" style="margin: 2rem 0">
						<div class="price-block agile">
							<div class="panel panel-primary">
								<div class="panel-heading">
									ADDITIONAL RESERVATION INFORMATION
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label>Special Request</label>
									<input id="request" name="request" class="form-control" placeholder="optional">
								</div>
								<br>
								<div class="form-group">
									<label>Check-In</label>
									<input id="cin" name="cin" type="date" class="form-control">

								</div>
								<br>
								<div class="form-group">
									<label>Check-Out</label>
									<input id="cout" name="cout" type="date" class="form-control">
								</div>
								<br>
								<!-- <div class="form-group">
									<label>Check-In/Check-Out Time</label>
									<input id="start-end" name="start-end" type="time" class="form-control">
									<p>Check in time will also be the check out time</p>
								</div>
								<br> -->
								<div class="form-group">
									<label>Total Price: <span id="totalPrice"> </span> </label>

								</div>
								<br>



								<div class="form-group">
									<input id="submit" name="submit" type="button" class="form-control" value="Submit">
								</div>

								<input id="submit2" type="submit" style="display:none" />

								<script>
									var submit = document.getElementById("submit");


									document.getElementById("cin").min = new Date().toISOString().split("T")[0];
									document.getElementById("cout").min = new Date().toISOString().split("T")[0];
									submit.onclick = function (event) {

										console.log(`cin` + document.getElementById("cin").value)
										console.log(`cout` + document.getElementById("cout").value)



										var cinDate = new Date(document.getElementById("cin").value).getTime();
										var coutDate = new Date(document.getElementById("cout").value).getTime();

										if (coutDate == cinDate) {
											alert("Checkout date cannot be the same day as checkin date");
											return
										} else if (coutDate < cinDate) {
											alert("Invalid Checkout date");
											return
										}
										console.log("Continue to next code.......")


										var fname = document.getElementById("fname").value
										var lname = document.getElementById("lname").value
										var email = document.getElementById("email").value
										var phone = document.getElementById("phone").value
										var request = document.getElementById("request").value
										var cin = document.getElementById("cin").value
										var cout = document.getElementById("cout").value
										//var startEnd = document.getElementById("start-end").value

										//check required fields
										if (fname.trim() == "" || lname.trim() == "" || email.trim() == "" ||
											phone.trim() == "" || cin.trim() == "" || cout.trim() == "" 

										) {
											console.log("Please fill all the required fields!")
											alert("Please fill all the required fields!");
										} else {
											document.getElementById("submit2").click()
										}

										//console.log(startEnd)



									}
								</script>


								<script>
									const dateChange = () => {
										//date script 

										var cinDate = new Date(document.getElementById("cin").value).getTime();
										var coutDate = new Date(document.getElementById("cout").value).getTime();

										var priceOfRoom = '<?php echo $room_info["price"] ?>';
										console.log(`Base Price of Room` + priceOfRoom);

										if (coutDate != cinDate && coutDate > cinDate) {
											console.log("Valid Input..... Continue to operation.........");

											var diff = coutDate - cinDate;

											var daydiff = diff / (1000 * 60 * 60 * 24);



											var totalPrice = parseInt(daydiff) * parseFloat(priceOfRoom);
											console.log("Room Price" + totalPrice)

											//totalPrice
											document.getElementById("totalPrice").innerHTML = "&#8369;" + totalPrice
										} else {
											document.getElementById("totalPrice").innerHTML = ""
										}
									}

									document.getElementById("cout").onchange = dateChange;
									document.getElementById("cin").onchange = dateChange;
								</script>

							</div>

						</div>
					</div>

					<!--  -->

					<?php if (!$room_is_available) {
						echo "<style>
						
						.add-info{
							display: none;
						}
					</style>";
					} ?>



				</div>
			</div>
		</div>
	</form>
</body>

</html>