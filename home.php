<?php
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
$firstName=$_SESSION['varname4'];
$lastName=$_SESSION['varname5'];
$contacts;
if($count==0){
    header ("Location:index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap2.min.css">
    

    
  </head>

  <body>

	<!--Menu bar-->
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li class="active" role="presentation"><a href="about.php">Settings</a></li>
            <li role="presentation"><a href="login.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Hello
            <?php echo $firstName; ?> 
        </h3>
      </div>

    <div class="jumbotron">
    <div class="row">
      <div class="col-sm-5 col-md-3">
        <!--Users List-->
          <ul class="list-group">
             <li class="list-group-item list-group-item-warning ">
                Chat
             </li>
             <!--Importing users to an unordered list-->
             <?php
              include('includes/database.php');
              //Create login query        
                $query="SELECT first_name as 'First Name' , last_name as 'Last Name', id as 'id' from users;"; 
	            //Get results
              $result=$mysqli->query($query);
              if($result->num_rows>0){
                //Loop through results
                while($row=$result->fetch_assoc()){
                    //Display student info   
                    if($row['id']!=$userid){
                    $output  ='<li class="list-group-item"><input id="'.$row['id'].'" type="button"  value="';
                    $output .=$row['First Name'].'&nbsp;'.$row['Last Name'];
                    $output .='"onclick="importChats('.$row['id'].')" /></li>';
                    echo $output;
                    }
                }
            }else{
                echo '<span style="color:red;">Sorry, no users were found</span>';
            }
             ?>
            </ul>
      </div>

      <!--Message Viewer-->
      <div class="col-md-8">
          <div id="showChats">
              <?php
              $scrollCounter=0;
              $_SESSION['varname6']=$scrollCounter;
              ?>
          </div>
      </div>
    </div>

    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Send messages when click send button-->
    <script type="text/javascript">
      function importChats(x) {   
        
        var chatPartner = x;
        //This is to refresh page after send a message
        $('#showChats').load('importChats.php?cp='+chatPartner);
    }
    
    </script>






    </body>
</html>