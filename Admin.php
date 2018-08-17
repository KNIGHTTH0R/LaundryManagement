<?php
include 'conn.php';
session_start ();
$uname = $_SESSION ['un'];
$j = $_SESSION ['j'];
$arr = array ();
if (isset ( $_POST ['adsubmit'] )) {
	for($i = 0; $i < $j; $i ++) {
		$nsta = "s" . $i;
		$nrec = "r" . $i;
		$ndel = "d" . $i;
		$noid = "o" . $i;
		$status = $_POST [$nsta];
		$rec = $_POST [$nrec];
		$del = $_POST [$ndel];
		$oid = $_SESSION [$noid];
		
		if ($status == 'Ordered' || $status == 'Collection' 
			|| $status == 'Processing' || $status == 'Dispatched' 
			|| $status == 'Delivered') {
			if (($rec != NULL && $rec < date ( "Y-m-d" )) 
				|| ($del != NULL && $del < date ( "Y-m-d" )) || ($rec == NULL && $del != NULL)) {
				array_push ( $arr, $i );
			} else {
				$qry16 = "update allorder set deldate='" 
						. $del . "' where oid=" . $oid . ";";
				$qry17 = "update curorder set status='" . $status 
						. "',recdate='" . $rec . "',deldate='" . $del . "' where oid=" . $oid . ";";
				$qry18 = "update curorder set status='" . $status 
						. "',recdate='" . $rec . "' where oid=" . $oid . ";";
				$qry19 = "update curorder set status='" . $status . "' where oid=" . $oid . ";";
				if ($del != NULL && $rec != NULL) {
					if ($rec > $del) {
						array_push ( $arr, $i );
					} else {
						$res16 = $conn->query ( $qry16 );
						$res17 = $conn->query ( $qry17 );
					}
				} else if ($del == NULL && $rec != NULL) {
					$res18 = $conn->query ( $qry18 );
				} else {
					$res19 = $conn->query ( $qry19 );
				}
				if ($status == 'Delivered') {
					$qry20 = "delete from curorder where oid=" . $oid . ";";
					$res20 = $conn->query ( $qry20 );
				}
			}
		} else {
			array_push ( $arr, $i );
		}
	}
}
if($arr != NULL)
	for($i=0 ; $i<sizeof($arr) ; $i++)
		echo ("<script>alert('Error at order '.$arr[$i]);</script>'");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin</title>
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
					<li><a data-toggle="modal" data-target="#Modal1" id="m">All Orders</a></li>
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
					<button type="button" class="close" data-dismiss="modal" id="b1">&times;</button>
					<h4 class="modal-title">All Orders</h4>
				</div>
				<div class="modal-body form-group">
					<h3>Order Details:</h3>
				<?php
				$qry21 = "select * from allorder;";
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

	<div class="container jumbotron" id="d1">
		<h2>Current orders</h2>
		<hr>
		<br>
		<div id="d11">
		<?php
		$qry1 = "select c.oid,c.uid,c.status,cl.ctshirtno,cl.cttshirtno,cl.ctpantno,cl.ctsareeno,cl.slksareeno,cl.kurtano,cl.woollenno,cl.jeansno,cl.othersno,clw.ctshirtno as ctshirtnow,clw.cttshirtno as cttshirtnow,clw.ctpantno as ctpantnow,clw.ctsareeno as ctsareenow,clw.slksareeno as slksareenow,clw.kurtano as kurtanow,clw.woollenno as woollennow,clw.jeansno as jeansnow,clw.othersno as othersnow,c.totalcloth,c.totalprice,c.orddate,c.recdate,c.deldate from curorder c,clothno cl,clothnow clw where c.oid=cl.oid and c.oid=clw.oid;";
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
		?>
			<form class="form-horizontal" method="post">
			<?php
			if ($res1->num_rows > 0) {
				$j = 0;
				while ( (($row1 = $res1->fetch_assoc ()) > 0) ) {
					echo "<u><h3>Order ID : " . $row1 ['oid'] . "</h3></u>";
					echo "User id : " . $row1 ['uid'] . "<br>";
					echo "Status : " . "<input type='text' name='s" . $j . "' class='form-inline' value='" . $row1 ['status'] . "'><br>";
					echo "<table class='table table-bordered table-hover'>
							<tr>
								<th>Item</th>
								<th>Wash Type</th>
								<th>Quantity</th>
							</tr>";
					$i = 0;
					$wash = "Dry";
					foreach ( $row1 as $x => $x_value ) {
						if ($x == "oid" || $x == "status" || $x == "uid")
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
					echo "Recieving date : " . "<div><input type='date' name='r" . $j . "' class='form-inline' value='" . $recdate . "'></div>";
					echo "Delivery date : " . "<div><input type='date' name='d" . $j . "' class='form-inline' value='" . $deldate . "'></div>";
					echo "Total Number of Clothes : " . $count . "<br>";
					echo "Total Price : Rs " . $sum . "<br><br>";
					$id = "o" . $j;
					$_SESSION [$id] = $row1 ['oid'];
					$j ++;
					$_SESSION ['j'] = $j;
				}
			} else
				echo "No Orders..!!";
			?>
		<input type="submit" id="adsubmit" name="adsubmit" value="Submit"
					class="form-control">
			</form>
		</div>
	</div>
</body>
</html>