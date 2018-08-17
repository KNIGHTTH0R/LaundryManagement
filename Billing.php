<?php
include 'conn.php';
session_start ();
$uname = $_SESSION ['un'];

$qry = "select uid from profile where username = '" . $uname . "';";
$res = $conn->query ( $qry );
if ($res->num_rows == 1) {
	$row = $res->fetch_assoc ();
	$uid = $row ['uid'];
}

$paddress = $_SESSION ['paddress'];
$dry = $_SESSION ['dry'];
$wet = $_SESSION ['wet'];
$count = $_SESSION ['count'];
$sum = $_SESSION ['sum'];

for($i = 0; $i < 9; $i ++) {
	if ($dry [$i] == NULL) {
		$dry [$i] = 0;
	}
}
for($i = 0; $i < 9; $i ++) {
	if ($wet [$i] == NULL) {
		$wet [$i] = 0;
	}
}

if (isset ( $_POST ['r'] )) {
	if ($_POST ['r'] == "padd") {
		if ($paddress != NULL) {
			$qry5 = "insert into allorder values (DEFAULT," . $uid . ","
					. $count . "," . $sum . ",NULL,curdate());";
			$res5 = $conn->query ( $qry5 );
			if ($res5 === TRUE) {
				$qry6 = "select max(oid) from allorder where uid = " . $uid . ";";
				$res6 = $conn->query ( $qry6 );
				$row6 = $res6->fetch_assoc ();
				
				$qry7 = "insert into curorder values (" . $row6 ['max(oid)'] 
						. "," . $uid . ",'Ordered'," . $count . "," . $sum . 
						",NULL,curdate(),NULL);";
				$res7 = $conn->query ( $qry7 );
				
				$qry8 = "insert into clothno values (" . $row6 ['max(oid)'] . "," 
						. $dry [0] . "," . $dry [1] . "," . $dry [2] . "," 
						. $dry [3] . "," . $dry [4] . "," . $dry [5] . "," 
						. $dry [6] . "," . $dry [7] . "," . $dry [8] . ");";
				$qry9 = "insert into clothnow values (" . $row6 ['max(oid)'] . "," 
						. $wet [0] . "," . $wet [1] . "," . $wet [2] . "," 
						. $wet [3] . "," . $wet [4] . "," . $wet [5] . "," 
						. $wet [6] . "," . $wet [7] . "," . $wet [8] . ");";
				$res8 = $conn->query ( $qry8 );
				$res9 = $conn->query ( $qry9 );
				
				
				$qry10 = "insert into location values (" . $row6 ['max(oid)'] . ",'" 
						. $paddress ['street'] . "','" . $paddress ['city'] . "','" 
						. $paddress ['landmark'] . "');";
				$res10 = $conn->query ( $qry10 );
				header ( "location: User.php" );
			}
		} else {
			header ( "location: User.php" );
		}
	} else {
		$qry5 = "insert into allorder values (DEFAULT," . $uid . "," . $count 
				. "," . $sum . ",NULL,curdate());";
		$res5 = $conn->query ( $qry5 );
		$qry6 = "select max(oid) from allorder where uid = " . $uid . ";";
		$res6 = $conn->query ( $qry6 );
		$row6 = $res6->fetch_assoc ();
		
		$qry7 = "insert into curorder values (" . $row6 ['max(oid)'] 
				. "," . $uid . ",'Ordered'," . $count . "," . $sum . 
				",NULL,curdate(),NULL);";
		$res7 = $conn->query ( $qry7 );
		
		$qry8 = "insert into clothno values (" . $row6 ['max(oid)'] . "," 
				. $dry [0] . "," . $dry [1] . "," . $dry [2] . "," 
				. $dry [3] . "," . $dry [4] . "," . $dry [5] . "," 
				. $dry [6] . "," . $dry [7] . "," . $dry [8] . ");";
		$qry9 = "insert into clothnow values (" . $row6 ['max(oid)'] . "," 
				. $wet [0] . "," . $wet [1] . "," . $wet [2] . "," 
				. $wet [3] . "," . $wet [4] . "," . $wet [5] . "," 
				. $wet [6] . "," . $wet [7] . "," . $wet [8] . ");";
		$res8 = $conn->query ( $qry8 );
		$res9 = $conn->query ( $qry9 );
		$iaddress = array (
				$_POST ['street'],
				$_POST ['city'],
				$_POST ['landmark'] 
		);
		$qry10 = "insert into location values (" . $row6 ['max(oid)'] . ",'" 
				. $iaddress [0] . "','" . $iaddress [1] . "','" 
				. $iaddress [2] . "');";
		$res10 = $conn->query ( $qry10 );
		
		header ( "location: User.php" );
	}
}
?>