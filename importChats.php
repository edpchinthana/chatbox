<?php
$chatPartnerId = $_GET['cp'];
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
$firstName=$_SESSION['varname4'];
$LastName=$_SESSION['varname5'];
$scrollCounter=$_SESSION['varname6'];
if($count==0){
    header ("Location:login.php");
}
?>
<?php   
        
        $userTableName="test";
        $chatPartnerTableName="test";

        //Including the database conenction
        include('includes/database.php');

        //Importing user table name
        $query1="select username from users where id=$userid;";
        $result=$mysqli->query($query1);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $userTableName=$row['username'];
            }
        }

        //Importing chat partner table name
        $query1="select username from users where id=$chatPartnerId;";
        $result=$mysqli->query($query1);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $chatPartnerTableName=$row['username'];
            }
        }
        //Importing messages
        $query="SELECT message,type,date from $userTableName where chatpartner=$chatPartnerId;";
        $result=$mysqli->query($query);
        if($result->num_rows>0){
            //Loop through results
            while($row=$result->fetch_assoc()){
                //Display student info
                if($row['type']=='0'){
                    $output  ='<div class="card border-primary float-left col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>';
                    $output .=$chatPartnerTableName;
                }
                else{
                    $output  ='<div class="card border-warning float-right col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>';
                    $output .=$username;
                }
                
                $output .='</b></h5><div class="card-body py-0">';
                $output .= $row['message'].'</div><div class="text-muted text-right">';
                $output .=$row['date'].'</div>';
                $output .='</div><br>';
                if($scrollCounter==0){
                $output .='<script>window.scrollBy(0, 100);</script>';
                }
                echo $output;
            }
        }else{
            echo '<span style="color:red;">Sorry, no previous messages were found</span>';
        }
        $scrollCounter++;
        $_SESSION['varname4']=$scrollCounter;
        ?>