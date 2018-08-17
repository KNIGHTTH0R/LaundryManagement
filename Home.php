<?php
include 'conn.php';
session_start ();
if (isset ( $_POST ['s1'] )) {
	$fname = $_POST ['firstname'];
	$lname = $_POST ['lastname'];
	$uname = $_POST ['uname'];
	$email = $_POST ['email'];
	$passw = md5 ( $_POST ['passw'] );
	$phno = $_POST ['phno'];

	$qry1 = "insert into loginuser values ('" . $uname . "','" . $passw . "');";
	$qry2 = "insert into profile values (DEFAULT,'" . $uname . "','" . $fname . "','"
			. dielname . "',NULL,NULL,NULL,NULL,'" . $email . "','" . $phno . "');";
if ($conn->query ( $qry1 ) === TRUE) {
		$conn->query ( $qry2 );
	} else {
		echo ("<script>alert('Username already taken..!!');</script>'");
	}
} elseif (isset ( $_POST ['s2'] )) {
	$uname = $_POST ['uname'];
	$passw = md5($_POST ['passw']);
	
	$qry3 = "select * from 	loginuser where username = '"
			. $uname . "' and password = '". $passw . "';";
	$res = $conn->query ( $qry3 );
	if ($res->num_rows == 1) {
		$row = $res->fetch_assoc ();
		$_SESSION ['un'] = $row ['username'];
		header ( "location: User.php" );
	} else {
		echo '<script>alert("Invalid Username or Password..!!");</script>';
	}
} elseif (isset ( $_POST ['s3'] )) {
	$uname = $_POST ['uname'];
	$passw = $_POST ['passw'];
	
	$qry3 = "select * from 	loginadmin where username = '"
			. $uname . "' and password = '" . $passw . "';";
	$res = $conn->query ( $qry3 );
	if ($res->num_rows == 1) {
		$row = $res->fetch_assoc ();
		$_SESSION ['un'] = $row ['username'];
		header ( "location: Admin.php" );
	} else {
		echo '<script>alert("Admin not found..!!");</script>';
	}
}
$conn->close ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {
	position: relative;
}

li {
	font: "Times New Roman";
}

#d2 {
	height: 400px;
	background-image: url("bk3.jpg");
	overflow: hidden;
}

#d2 img {
	width: 100%;
}

#d3 {
	height: 500px;
	font: "Roboto Condensed";
}

#d4 {
	width: 50%;
	padding-top: 2%;
	margin-top: 5%;
	text-align: center;
	color: #000000;
}

#d6 a {
	color: #ffffff;
}

#a1 {
	width: 33%;
}

#a2 {
	margin-left: 40%;
	float: right;
}

.left {
	float: left;
	width: 33%;
}

.left a {
	color: #ffffff;
}

#section1 {
	padding-top: 50px;
	height: 400px;
	color: #000;
	background-color: #ffc107;
	padding-left: 100px
}

#section2 {
	padding-top: 50px;
	height: 400px;
	color: #000;
	background-color: #ff9800;
	padding-left: 100px
}

#section3 {
	padding-top: 20px;
	height: 300px;
	color: #000;
	background-color: #ff5722;
	padding-left: 250px
}

#section3 a {
	color: #000;
}

#link a {
	cursor: pointer;
}
/* #n1 { */
/* 	background-color: #ffeb3b; */
/* } */
/* li.active a {  */
/* 	background-color: #ffff72 !important;  */
/* } */
</style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="100">
	<nav class="navbar navbar-default navbar-fixed-top" id="n1">
		<div class="container-fluid">
			<div class="navbar-header" id="Ti">
				<div>
					<a class="navbar-brand" href="#">Laundry</a>
				</div>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#section1">About</a></li>
					<li><a href="#section2">Features</a></li>
					<li><a href="#section3">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right" id="link">
					<li><a data-toggle="modal" data-target="#myModal1"><span
							class="glyphicon glyphicon-new-window"></span> Sign Up</a></li>
					<li><a data-toggle="modal" data-target="#myModal2"><span
							class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<li><a data-toggle="modal" data-target="#myModal3"><span
							class="glyphicon glyphicon-log-in"></span> Login Admin</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="myModal1" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sign Up</h4>
				</div>
				<div class="modal-body form-group">
					<form class="form-horizontal" method="post">
						<div class="form-inline" id="f1">
							<label class="col-sm-6">First Name</label> <input type="text"
								class="form-control" id="firstname"
								placeholder="Enter firstname" name="firstname">
						</div>
						<br> <br>
						<div class="form-inline" id="f2">
							<label class="col-sm-6">Last name</label> <input type="text"
								class="form-control" id="lastname" placeholder="Enter lastname"
								name="lastname">
						</div>
						<br> <br>
						<div class="form-inline" id="f3">
							<label class="col-sm-6">EmailId</label> <input type="email"
								class="form-control" id="email" placeholder="Enter email"
								name="email">
						</div>
						<br> <br>
						<div class="form-inline" id="f4">
							<label class="col-sm-6">Username</label> <input type="text"
								class="form-control" id="uname" placeholder="Enter Username"
								name="uname">
						</div>
						<br> <br>
						<div class="form-inline" id="f4">
							<label class="col-sm-6">Password</label> <input type="password"
								class="form-control" id="passw" placeholder="Enter Password"
								name="passw">
						</div>
						<br> <br>
						<div class="form-inline" id="f5">
							<label class="col-sm-6">Phone number</label> <input type="tel"
								class="form-control" id="phno" placeholder="Enter Phone number"
								name="phno" maxlength="10" />
						</div>
						<br> <br>
						<div class="form-inline">
							<div id="f5" class="col-sm-3">
								<input type="submit" value="SUBMIT" class="btn" id="s1"
									name="s1">
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
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="b2">Close</button>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Login</h4>
				</div>
				<div class="modal-body form-group" id="dd">
					<form class="form-horizontal" method="post">
						<div class="form-inline" id="f3">
							<label class="col-sm-6">Username</label> <input type="text"
								class="form-control" id="uname" placeholder="Enter username"
								name="uname">
						</div>
						<br> <br>
						<div class="form-inline" id="f4">
							<label class="col-sm-6">Password</label> <input type="password"
								class="form-control" id="passw" placeholder="Enter Password"
								name="passw">
						</div>
						<br> <br>
						<div class="form-inline">
							<div id="f5" class="col-sm-3">
								<input type="submit" value="LOGIN" id="s2" name="s2" class="btn">
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
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="b2">Close</button>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal3" role="dialog">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Login Admin</h4>
				</div>
				<div class="modal-body form-group" id="dd">
					<form class="form-horizontal" method="post">
						<div class="form-inline" id="f3">
							<label class="col-sm-6">Username</label> <input type="text"
								class="form-control" id="uname" placeholder="Enter username"
								name="uname">
						</div>
						<br> <br>
						<div class="form-inline" id="f4">
							<label class="col-sm-6">Password</label> <input type="password"
								class="form-control" id="passw" placeholder="Enter Password"
								name="passw">
						</div>
						<br> <br>
						<div class="form-inline">
							<div id="f5" class="col-sm-3">
								<input type="submit" value="LOGIN" id="s3" name="s3" class="btn">
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
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="b2">Close</button>
			</div>
		</div>
	</div>

	<div class="container-fluid jumbotron"
		style="margin-bottom: -1%; height: 500px" id="d2">
		<div id="d4">
			<h1>Online Laundry Service</h1>
			<hr>
		</div>
	</div>
	<div id="section1" class="container-fluid">
		<h1>About</h1>
		<hr>
		<h3></h3>
		<h3></h3>
	</div>
	<div id="section2" class="container-fluid">
		<h1>Features</h1>
		<hr>
		<h3></h3>
		<h3></h3>
	</div>
	<div id="section3" class="container-fluid">
		<h1>Contact Us</h1>
		<div class="left">
			<h2>Links</h2>
			<br>
			<h3>
				<a href="#section1">About</a><br> <br> <a href="#section2">Features</a>
			</h3>
		</div>
		<div class="left">
			<div>
				<h2>Developers</h2>
				<br>
				<h4>
					<br> Team
				</h4>
			</div>
		</div>
		<div class="left">
			<div>
				<h2></h2>
				<br>
				<h3>
					<br> <a href="" data-toggle="modal" data-target="#myModal1">Sign Up</a>
					<br> <br> <a href="" data-toggle="modal" data-target="#myModal2">Login</a>
				</h3>
			</div>
		</div>
	</div>
</body>
</html>
