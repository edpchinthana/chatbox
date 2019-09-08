<?php
//Connect to database
//Here are the values need to access the database
$db_host='localhost';
$db_name = 'chat';
$db_user='root';
$db_password='';

//Create mysqli object
$mysqli = new mysqli($db_host,$db_user,$db_password,$db_name);

//Error Handling
if(mysqli_connect_errno()){
	echo 'This connection failed'.mysqli_connect_error();
	die();
}

?>