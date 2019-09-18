<?php
//Security system
session_start();
$chatPartnerId = $_GET['cp'];
$message = $_GET['msg'];
$count=$_SESSION['varname1'];
$userid=$_SESSION['varname3'];
$scrollCounter=$_SESSION['varname6'];
if($count==0){
    header ("Location:login.php");
}
?>
<?php
    include('includes/database.php');
//Importing chat data
        $userTableName="test";
        $chatPartnerTableName="test";
        $partnerFirstName="test";
        $partnerLastName="test";

        //Including the database conenction
        include('includes/database.php');

        //Importing user table name
        $query1="select username,first_name, last_name from users where id=$userid;";
        $result=$mysqli->query($query1);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $userTableName=$row['username'];
                $firstName=$row['first_name'];
                $lastName=$row['last_name'];
            }
        }

        //Importing chat partner table name, first name, last name
        $query1="select username,first_name,last_name from users where id=$chatPartnerId;";
        $result=$mysqli->query($query1);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $chatPartnerTableName=$row['username'];
                $partnerFirstName=$row['first_name'];
                $partnerLastName=$row['last_name'];
            }
        }

    
    //Create send message query to user's table
    if($message!=""){
    $query="INSERT INTO `$userTableName` (`chatPartner`,`type`,`message`) VALUES ('$chatPartnerId','1','$message');"; 
	//Get results
    $result=$mysqli->query($query);   

    //Create send message query to partner's table
        $query="INSERT INTO `$chatPartnerTableName` (`chatPartner`,`type`,`message`) VALUES ('$userid','0','$message');"; 
        //Get results
        $result=$mysqli->query($query);  
    }
            //Setting chat header
            echo "<div class='card col-md-12 bg-warning'><h3>".$partnerFirstName."&nbsp;&nbsp;".$partnerLastName."</h3></div>";
    
     //Importing messages
     $query="SELECT message,type,date from $userTableName where chatpartner=$chatPartnerId;";
     $result=$mysqli->query($query);
     if($result->num_rows>0){
         //Loop through results
         while($row=$result->fetch_assoc()){
             //Display student info
             if($row['type']=='0'){
                 $output  ='<div class="card border-primary float-left col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>';
                 $output .=$partnerFirstName;
             }
             else{
                 $output  ='<div class="card border-warning float-right col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>You';
                 
             }
             
             $output .='</b></h5><div class="card-body py-0">';
             $output .= $row['message'].'</div><div class="text-muted text-right">';
             $output .=$row['date'].'</div>';
             $output .='</div><br>';
             $output .='<script>window.scrollBy(0, 100);</script>';
             echo $output;
         }
     }else{
         echo '<span style="color:red;">Sorry, no previous messages were found</span>';
     }   
    
    
?>