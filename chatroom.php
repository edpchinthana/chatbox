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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Chat Room</title>
    <link rel="stylesheet" type="text/css" href="css/myCSS.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap2.min.css">
  </head>

  <body>

	<!--Menu bar-->
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="login.php">Login</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Chat Room</h3>
      </div>

	<!--Body-->
      <div class="jumbotron" style="height:100vh;">
       <div class=" col-xs-12">
        <br>
        <?php
        include('includes/database.php');
        $query="SELECT chat.message as 'message', users.name as 'userid' from users inner join chat on users.id=chat.userId;";
        $result=$mysqli->query($query);

        if($result->num_rows>0){
            //Loop through results
            while($row=$result->fetch_assoc()){
                //Display student info
                if($row['userid']==$username){
                    $output  ='<div class="card border-primary float-right col-xs-8"><h5 class="card-title"><b>';
                }
                else{
                $output  ='<div class="card border-warning float-left col-xs-8"><h5 class="card-title"><b>';
                }
                $output .=$row['userid'];
                $output .='</b></h5>';
                $output .= $row['message'].'<br>';
                $output .='</div>';
                echo $output;
            }
        }else{
            echo '<span style="color:red;">Sorry, no students records were found</span>';
        }
        ?>
        <br>
       </div>
       
      </div>
      <div class="jumbotron fixed-bottom p-5 m-0" style="background-color:rgb(150, 217, 243)">
            <form role="form" method="post" action="chatroom.php">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-xs-10">
                        <input name="text" type="text" class="form-control" placeholder="Enter your message">
                        </div>
                        <div class="col-xs-2">
                        <input type="submit" class="btn btn-warning w-100" value="Send"/>
                    </div>
                        </div>
                    </div>
                    <?php
                    if($_POST){
			            	//submitting values
			            	$txt=$_POST['text'];
				       
			        	//Create login query
			            	$query="INSERT INTO `chat` (`userId`, `message`) VALUES ('$userid','$txt');"; 
			        	//Get results
                            $result=$mysqli->query($query);  
                    }  
                    ?>
                </form>
      </div>
	<!--Footer-->
      <footer class="footer">
        
      </footer>

    </div>   
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
