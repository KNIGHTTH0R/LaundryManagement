<?php
include 'conn.php';
session_start ();
$uname = $_SESSION ['un'];

$qry = "select uid from profile where username = '" . $uname . "'";
$res = $conn->query ( $qry );
if ($res->num_rows == 1) {
	$row = $res->fetch_assoc ();
	$uid = $row ['uid'];
}

if (isset ( $_POST ['ps'] )) {
	$fname = $_POST ['firstname'];
	$lname = $_POST ['lastname'];
	$gender = $_POST ['gender'];
	$street = $_POST ['street'];
	$city = $_POST ['city'];
	$landmark = $_POST ['landmark'];
	$email = $_POST ['email'];
	$phno = $_POST ['phno'];
	$passw = $_POST ['passw'];
	
	if ($fname != NULL && $lname != NULL && $email != NULL) {
		$qry13 = "update profile set fname = '" . $fname . "', lname = '" 
				. $lname . "', gender = '" . $gender . "', street = '" 
				. $street . "', city = '" . $city . "', landmark = '" 
				. $landmark . "', email = '" . $email . "', phno = '" 
				. $phno . "' where uid = " . $uid . ";";
		$res13 = $conn->query ( $qry13 );
	} else {
		echo ("<script>alert('Invalid Entry');</script>'");
	}
	if ($passw != NULL) {
		$passw = md5 ( $_POST ['passw'] );
		$qry14 = "update loginuser set passw = '" . $passw . "' where uid = " . $uid . ";";
		$res14 = $conn->query ( $qry14 );
		if(!$res14) echo ("<script>alert('Error...Password not Changed..!!');</script>'");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>User</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<style type="text/css">
body {
	background-image: url("bk4.png");
	background-size: cover;
	background-attachment: fixed;
}

#d1, #d2 {
	width: 60%;
	padding-top: 1%;
	padding-left: 2%;
	background-color: #f2f2f2;
}

#d1 {
	margin-top: 5%;
}

#d11 {
	font-size: 20px;
	color: #0f0f0f;
	padding-left: 5%;
}

#m {
	cursor: pointer;
}
/* #n1 {
	background-color: #ffeb3b;
}
li.active a { 
	background-color: #ffff72 !important; 
} */
</style>
<script type="text/javascript">
</script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<nav
		class="navbar navbar-default navbar-fixed-top navbar-fixed-side-right"
		data-offset-top="100" id="n1">
		<div class="container-fluid">
			<div class="navbar-header" id="Ti">
				<div>
					<a class="navbar-brand" href="#">Laundry</a>
				</div>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a data-toggle="modal" data-target="#Modal1" id="m">Profile</a></li>
					<li><a data-toggle="modal" data-target="#Modal2" id="m">My Orders</a></li>
					<li><a data-toggle="modal" data-target="#Modal3" id="m">Check Price</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>
							Sign out</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="Modal1" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Profile</h4>
				</div>
				<div class="modal-body form-group">
				<?php
				$qry12 = "select * from profile where uid =".$uid.";";
				$res12 = $conn->query ( $qry12 );
				$row12 = $res12->fetch_assoc ();
				?>
					<form class="form-horizontal" method="post">
						<div class="form-inline" id="f1">
							<label class="col-sm-6">First Name</label> <input type="text"
								class="form-control" id="firstname"
								placeholder="Enter firstname" name="firstname"
								value="<?php echo $row12['fname']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f2">
							<label class="col-sm-6">Last name</label> <input type="text"
								class="form-control" id="lastname" placeholder="Enter lastname"
								name="lastname" value="<?php echo $row12['lname']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f3">
							<label class="col-sm-6">EmailId</label> <input type="email"
								class="form-control" id="email" placeholder="Enter email"
								name="email" value="<?php echo $row12['email']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f4">
							<label class="col-sm-6">Change Password</label> <input
								type="password" class="form-control" id="passw"
								placeholder="Enter Password" name="passw">
						</div>
						<br> <br>
						<div class="form-inline" id="f5">
							<label class="col-sm-6">Phone number</label> <input type="tel"
								class="form-control" id="phno" placeholder="Enter Phone number"
								name="phno" max=10 value="<?php echo $row12['phno']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f6">
							<label class="col-sm-6">Gender</label> <input type="text"
								class="form-control" id="gender" placeholder="Enter Gender"
								name="gender" max=7 value="<?php echo $row12['gender']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f7">
							<label class="col-sm-6">Street</label> <input type="text"
								class="form-control" id="street" placeholder="Enter Street"
								name="street" max=40 value="<?php echo $row12['street']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f8">
							<label class="col-sm-6">City</label> <input type="text"
								class="form-control" id="city" placeholder="Enter City"
								name="city" max=40 value="<?php echo $row12['city']; ?>">
						</div>
						<br> <br>
						<div class="form-inline" id="f8">
							<label class="col-sm-6">Landmark</label> <input type="text"
								class="form-control" id="landmark" placeholder="Enter Landmark"
								name="landmark" max=40 value="<?php echo $row12['landmark']; ?>">
						</div>
						<br> <br>
						<div class="form-inline">
							<div id="f5" class="col-sm-3">
								<input type="submit" value="SUBMIT" class="btn" id="s1"
									name="ps">
							</div>
							<div id="f5" class="col-sm-3">
								<input type="reset" value="RESET" class="btn">
							</div>
						</div>
					</form>
					<br> <br>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>

	<div class="modal fade" id="Modal2" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" id="b1">&times;</button>
					<h4 class="modal-title">My Orders</h4>
				</div>
				<div class="modal-body form-group">
					<h3>Order Details</h3>
				<?php
				$qry21 = "select * from allorder where uid=" . $uid . ";";
				$res21 = $conn->query ( $qry21 );
				if ($res21->num_rows > 0) {
					echo "<table class='table table-bordered table-hover'>";
					echo "<tr><th>OrderID</th>
									<th>UserID</th>
									<th>Total Cloths</th>
									<th>Total Price</th>
									<th>Delivery</th>
									<th>Order</th>
								</tr>";
					while ( ($row21 = $res21->fetch_assoc ()) > 0 ) {
						echo "<tr><td>" . $row21 ['oid'] . "</td>
									<td>" . $row21 ['uid'] . "</td>
									<td>" . $row21 ['totalcloth'] . "</td>
									<td>" . $row21 ['totalprice'] . "</td>
									<td>" . $row21 ['deldate'] . "</td>
									<td>" . $row21 ['orddate'] . "</td>
								</tr>";
					}
					echo "</table>";
				}
				?>				
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="b2">Close</button>
			</div>
		</div>
	</div>

	<div class="modal fade" id="Modal3" role="dialog">
		<div class="modal-dialog modal-lg" id="b3">
			<div class="modal-content" id="b4">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" id="b1">&times;</button>
					<h4 class="modal-title">Check Price</h4>
				</div>
				<div class="modal-body form-group" id="dd">
				<table class="table table-bordered table-hover" id="table">
				<tr><th>Wash</th>
				<th>Cotton Shirt</th>
				<th>Cotton T-Shirt</th>
				<th>Cotton Pant</th>
				<th>Cotton Saree</th>
				<th>Silk Saree</th>
				<th>Kurta</th>
				<th>Woollen</th>
				<th>Jeans</th>
				<th>Others</th>
				</tr>
				<?php 
				$qry2 = "select * from pricecloth;";
				$res2 = $conn->query($qry2);
				if($res2->num_rows > 0) {
					while(($row2 = $res2->fetch_assoc()) > 0) {
						echo "<tr><th>".$row2['wash']."</th>
						<td>".$row2['ctshirt']."</td>
						<td>".$row2['cttshirst']."</td>
						<td>".$row2['ctpant']."</td>
						<td>".$row2['ctsaree']."</td>
						<td>".$row2['slksaree']."</td>
						<td>".$row2['kurta']."</td>
						<td>".$row2['woollen']."</td>
						<td>".$row2['jeans']."</td>
						<td>".$row2['others']."</td>
						</tr>";
					}
				}
				?>
				</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="b2">Close</button>
			</div>
		</div>
	</div>

	<div class="container jumbotron" id="d1">
		<h2>Current Order</h2><hr>
		<br>
		<div id="d11">
			<?php
			$qry1 = "select c.oid,c.status,cl.ctshirtno,cl.cttshirtno,cl.ctpantno,cl.ctsareeno,cl.slksareeno,cl.kurtano,cl.woollenno,cl.jeansno,cl.othersno,clw.ctshirtno as ctshirtnow,clw.cttshirtno as cttshirtnow,clw.ctpantno as ctpantnow,clw.ctsareeno as ctsareenow,clw.slksareeno as slksareenow,clw.kurtano as kurtanow,clw.woollenno as woollennow,clw.jeansno as jeansnow,clw.othersno as othersnow,c.totalcloth,c.totalprice,c.orddate,c.recdate,c.deldate from curorder c,clothno cl,clothnow clw where c.oid=cl.oid and c.oid=clw.oid and c.uid=" . $uid . ";";
			$res1 = $conn->query ( $qry1 );
			$tr = array (
					"Cotton Shirt",
					"Cotton Tshirt",
					"Cotton Pant",
					"Cotton Saree",
					"Silk Saree",
					"Kurta",
					"Woollen",
					"Jeans",
					"Others" 
			);
			$count = 0;
			$sum = 0;
			if ($res1->num_rows > 0) {
				while ( (($row1 = $res1->fetch_assoc ()) > 0) ) {
					echo "<h3>Order ID : " . $row1 ['oid'] . "</h3>";
					echo "Status : " . $row1 ['status'] . "<br>";
					echo "<table class='table table-bordered table-hover'>
							<tr>
								<th>Item</th>
								<th>Wash Type</th>
								<th>Quantity</th>
							</tr>";
					$i = 0;
					$wash = "Dry";
					foreach ( $row1 as $x => $x_value ) {
						if ($x == "oid" || $x == "status")
							continue;
						else if ($x == "totalcloth")
							$count = $x_value;
						else if ($x == "totalprice")
							$sum = $x_value;
						else if ($x == "orddate")
							$orddate = $x_value;
						else if ($x == "recdate")
							$recdate = $x_value;
						else if ($x == "deldate")
							$deldate = $x_value;
						else if ($x_value) {
							echo ("<tr>
											<td>" . $tr [$i] . "</td>
											<td>$wash</td>
											<td>" . $x_value . "</td>
										</tr>");
							$i ++;
						} else
							$i ++;
						if ($i == 9) {
							$i = 0;
							$wash = "Wet";
						}
					}
					echo "</table>";
					echo "Ordered date : " . $orddate . "<br>";
					echo "Recieving date : " . $recdate . "<br>";
					echo "Delivery date : " . $deldate . "<br>";
					echo "Total Number of Clothes : " . $count . "<br>";
					echo "Total Price : Rs " . $sum . "<br><br>";
				}
			} else
				echo "No Orders..!!";
			?>
		</div>
		<br>
	</div>
	<div class="container jumbotron" id="d2">
		<h2>Place Order</h2><hr>
		<br>
		<div id="d11">
			Enter number of clothes <br><br>
			<form method="post" class="form-horizontal" id="form"
				action="Order.php">
				Dry Wash<br> <span class="control-label col-sm-2">Cotton Shirt</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctshirt"
						name="ctshirt" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Cotton T-Shirt</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="cttshirt"
						name="cttshirt" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Cotton Pant</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctpant" name="ctpant"
						placeholder="0" min="0" max="10">
				</div>
				<br>
				<br> <span class="control-label col-sm-2">Cotton Saree</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctsaree"
						name="ctsaree" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Silk Saree</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="slksaree"
						name="slksaree" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Kurta</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="kurta" name="kurta"
						placeholder="0" min="0" max="10">
				</div>
				<br>
				<br> <span class="control-label col-sm-2">Woollen</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="woollen"
						name="woollen" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Jeans</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="jeans" name="jeans"
						placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Others</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="others" name="others"
						placeholder="0" min="0" max="10">
				</div>
				<br> <br> <br> Wet Wash<br> <span class="control-label col-sm-2">Cotton
					Shirt</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctshirtw"
						name="ctshirtw" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Cotton T-Shirt</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="cttshirtw"
						name="cttshirtw" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Cotton Pant</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctpantw"
						name="ctpantw" placeholder="0" min="0" max="10">
				</div>
				<br>
				<br> <span class="control-label col-sm-2">Cotton Saree</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="ctsareew"
						name="ctsareew" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Silk Saree</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="slksareew"
						name="slksareew" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Kurta</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="kurtaw" name="kurtaw"
						placeholder="0" min="0" max="10">
				</div>
				<br>
				<br> <span class="control-label col-sm-2">Woollen</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="woollenw"
						name="woollenw" placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Jeans</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="jeansw" name="jeansw"
						placeholder="0" min="0" max="10">
				</div>
				<span class="control-label col-sm-3">Others</span>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="othersw"
						name="othersw" placeholder="0" min="0" max="10">
				</div>
				<br> <br> <br>
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" class="btn btn-default" id="submit">Next</button>
				</div>
				<div class="col-sm-2">
					<button type="reset" class="btn btn-default">Reset</button>
				</div>
			</form>
		</div>
		<br>
	</div>
</body>
</html>