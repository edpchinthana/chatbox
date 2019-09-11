<?php
$chatPartnerId = $_GET['cp'];
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
$firstName=$_SESSION['varname4'];
$LastName=$_SESSION['varname5'];

if($count==0){
    header ("Location:login.php");
}
?>
<?php   
        
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
                echo $output;
            }
        }else{
            echo '<span style="color:red;">Sorry, no previous messages were found</span>';
        }
        ?>