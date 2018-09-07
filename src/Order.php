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
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>
							Sign out</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container jumbotron" id="d1">
		<h2>Billing</h2>
		<hr>
		<br>
		<div id="d11">
			Order Details<br>
			<br>
			<?php
			// Dry wash
			$dry = array (
					$_POST ['ctshirt'],
					$_POST ['cttshirt'],
					$_POST ['ctpant'],
					$_POST ['ctsaree'],
					$_POST ['slksaree'],
					$_POST ['kurta'],
					$_POST ['woollen'],
					$_POST ['jeans'],
					$_POST ['others'] 
			);
			// Wet wash
			$wet = array (
					$_POST ['ctshirtw'],
					$_POST ['cttshirtw'],
					$_POST ['ctpantw'],
					$_POST ['ctsareew'],
					$_POST ['slksareew'],
					$_POST ['kurtaw'],
					$_POST ['woollenw'],
					$_POST ['jeansw'],
					$_POST ['othersw'] 
			);
			$_SESSION ['dry'] = $dry;
			$_SESSION ['wet'] = $wet;
			$flag = 0;
			for($i = 0; $i < 9; $i ++) {
				if ($dry [$i] || $wash [$i]) {
					$flag = 1;
					break;
				}
			}
			if ($flag == 0) {
				echo ("<script>alert('Please select the clothes for laundry..!!');</script>'");
				header ( "location: User.php" );
			}
			?>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Item</th>
					<th>Wash Type</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
				<?php
				$qry2 = "select * from pricecloth where wash = 'dry';";
				$qry3 = "select * from pricecloth where wash = 'wet';";
				$rdry = $conn->query ( $qry2 );
				$rwet = $conn->query ( $qry3 );
				$dryrow = $rdry->fetch_assoc ();
				$wetrow = $rwet->fetch_assoc ();
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
				$i = 0;
				$sum = 0;
				$count = 0;
				foreach ( $dryrow as $x => $x_value ) {
					if ($x_value == "dry")
						continue;
					if ($dry [$i]) {
						echo ("<tr>
										<td>" . $tr [$i] . "</td>
										<td>Dry</td>
										<td>" . $dry [$i] . "</td>
										<td>" . $dry [$i] * $x_value . "</td>
									</tr>");
						$sum += $dry [$i] * $x_value;
						$count += $dry [$i];
						$i ++;
					} else
						$i ++;
				}
				$i = 0;
				foreach ( $wetrow as $x => $x_value ) {
					if ($x_value == "wet")
						continue;
					if ($wet [$i]) {
						echo ("<tr>
										<td>" . $tr [$i] . "</td>
										<td>Wet</td>
										<td>" . $wet [$i] . "</td>
										<td>" . $wet [$i] * $x_value . "</td>
									</tr>");
						$sum += $wet [$i] * $x_value;
						$count += $wet [$i];
						$i ++;
					} else
						$i ++;
				}
				$_SESSION ['sum'] = $sum;
				$_SESSION ['count'] = $count;
				?>
			</table>
			<?php
			echo "<h3>Total Price : Rs " . $sum . "</h3><br>";
			?>
		</div>
	</div>
	<div class="container jumbotron" id="d2">
		<div id="d11">
			Order Details<hr><br>
			<br> Enter Address Details<br>
			<form action="Billing.php" method="post" class="form-horizontal"
				id="form">
				<table class="table table-hover table-bordered">
					<tr>
						<td><input type="radio" id="r1" name="r" value="padd"
							checked="checked"></td>
						<td><span>
			<?php
			$qry4 = "select street,city,landmark from profile where uid = '" . $uid . "';";
			$res4 = $conn->query ( $qry4 );
			$row4 = $res4->fetch_assoc ();
			if ($row4 ['street'] == null || $row4 ['city'] == null || $row4 ['landmark'] == null) {
				echo "Address is not updated in profile<br>";
			} else {
				$paddress = $row4 ['street'] . ", " . $row4 ['city'] . ", " . $row4 ['landmark'];
				echo $paddress . "<br>";
				$_SESSION ['paddress'] = $row4;
			}
			?>
			</span></td>
					</tr>
					<tr>
						<td><input type="radio" id="r2" name="r" value="iadd"></td>
						<td><span> Street: <input type="text" class="form-control"
								maxlength="40" id="street" name="street"> City: <input
								type="text" class="form-control" maxlength="40" id="city"
								name="city"> Landmark: <input type="text" class="form-control"
								maxlength="40" id="landmark" name="landmark">
						</span></td>
					</tr>
				</table>
				<div class="col-sm-2">
					<input type="submit" id="submit" name="submit" value="Confirm"
						class="form-control">
				</div>
				<br>
			</form>
			<br>Cash on Delivery is the only option available<br>
		</div>
	</div>
</body>
</html>