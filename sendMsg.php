<?php
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
if($count==0){
    header ("Location:login.php");
}
?>
<?php
    include('includes/database.php');
    $message=$_POST['message'];
    //Create login query
    if($message!=""){
    $query="INSERT INTO `chat` (`userId`, `message`) VALUES ('$userid','$message');"; 
    
	//Get results
    $result=$mysqli->query($query);   
    }
?>