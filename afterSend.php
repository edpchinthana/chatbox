<?php
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
$scrollCounter=$_SESSION['varname4'];
if($count==0){
    header ("Location:login.php");
}
?>

<?php   
        
        include('includes/database.php');
        $query="SELECT chat.message as 'message', users.username as 'userid',chat.dateTime as 'date' from users inner join chat on users.id=chat.userId order by date ASC;";
        $result=$mysqli->query($query);
        if($result->num_rows>0){
            //Loop through results
            while($row=$result->fetch_assoc()){
                //Display student info
                if($row['userid']==$username){
                    $output  ='<div class="card border-primary float-right col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>';
                }
                else{
                    $output  ='<div class="card border-warning float-left col-xs-8 m-2 px-1 py-1"><h5 class="card-title py-0"><b>';
                }
                $output .=$row['userid'];
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
        $scrollCounter++;
        $_SESSION['varname4']=$scrollCounter;
        ?>