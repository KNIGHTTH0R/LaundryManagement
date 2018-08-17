<?php
$conn = new mysqli ( "localhost:3306", "root", "root", "Project" );
if ($conn->connect_error) {
	echo ('<script>alert("Failed..!!");</script>');
}
?>