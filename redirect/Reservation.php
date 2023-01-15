<?php
session_start();

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

$que2 =  mysqli_query($con, "SELECT * FROM roombook WHERE room_id =  " . $_SESSION["room_id"] . " ");
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
	<title>Single Room</title>

	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
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
	<form style="display: block;" method="POST" action="#">
		<div class="plans-section" id="rooms" style="padding: 0;">
			<div class="container">
				<h3 class="title-w3-agileits " style="color:#fff;background: #3EA5CE;padding:1rem;width:100%"> Reservation
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
								<img src=" <?php echo $room_info["image"]?>" alt=" " class="img-responsive" />
							</div>
							<div class="price-gd-bottom">

							</div>
						</div>
					</div>

					<div class="col-md-6 price-grid">
						<div class="price-block agile">
							<div class="price-selet" style="text-align: left; margin-left: 1rem">
								<a href="../index.php">Back to Home</a>
							</div>

							<div class="price-gd-bottom">
								<h4> Type: &nbsp;<span> <?php echo $room_info["type"]; ?> </span> </h4>
							</div>
							<div class="price-gd-bottom">
								<h4> Price: &nbsp;<span> &#8369; <?php echo $room_info["price"]; ?> </span> </h4>
							</div>
							<div class="price-gd-bottom">
								<h4> Is Available ?: &nbsp;<span> <?php if ($room_is_available) {
																		echo "Yes";
																	} else {
																		echo "No";
																	}; ?> </span> </h4>
							</div>
							<div class="price-gd-bottom">
								<h4> Total Room Available: &nbsp;<span> <?php echo $total_available_room ?>
							</div>
							<div class="price-gd-bottom">

							</div>
						</div>
					</div>




					<!--  -->
					<div class="col-md-6 price-grid" style="margin: 2rem 0">
						<div class="price-block agile">
							<div class="panel panel-primary">
								<div class="panel-heading">
									PERSONAL INFORMATION
								</div>


								<div class="panel-body">
									<div class="form-group">
										<label>First Name*</label>
										<input name="fname" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Last Name*</label>
										<input name="lname" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Email Name*</label>
										<input name="email" class="form-control" required>
									</div>
									<br>
									<div class="form-group">
										<label>Phone Number*</label>
										<input name="phone" class="form-control" required>
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>

					<!--  -->
					<div class="col-md-6 price-grid" style="margin: 2rem 0">
						<div class="price-block agile">
							<div class="panel panel-primary">
								<div class="panel-heading">
									ADDITIONAL RESERVATION INFORMATION
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label>Special Request</label>
									<input name="request" class="form-control" placeholder="optional">
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
								<div class="form-group">
									<label>Total Price: <span id="totalPrice"> </span> </label>
			
								</div>
								<br>



								<div class="form-group">
									<input id="submit" name="submit" type="button" class="form-control" value="Submit">
								</div>

								<script>
									var submit = document.getElementById("submit");
									submit.preventDefault;

									document.getElementById("cin").min = new Date().toISOString().split("T")[0];
									document.getElementById("cout").min = new Date().toISOString().split("T")[0];
									submit.onclick = function() {
										console.log(`cin` + document.getElementById("cin").value)
										console.log(`cout` + document.getElementById("cout").value)



										var cinDate = new Date(document.getElementById("cin").value).getTime();
										var coutDate = new Date(document.getElementById("cout").value).getTime();

										if (coutDate == cinDate) {
											alert("Checkout date cannot be the same day as checkin date");
										} else if (coutDate < cinDate) {
											alert("Invalid Checkout date");
										}

									}
								</script>


								<script>

									const dateChange =  ()=>{
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
										}
										else{
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

				</div>
			</div>
		</div>
	</form>
</body>

</html>