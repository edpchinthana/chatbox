<?php
//Security system
session_start();
$count=$_SESSION['varname1'];
$username=$_SESSION['varname2'];
$userid=$_SESSION['varname3'];
$firstName=$_SESSION['varname4'];
$lastName=$_SESSION['varname5'];
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
             <li class="list-group-item"><button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Test</button></li>
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
                    $output  ='<li class="list-group-item">';
                    $output .=$row['First Name'].'&nbsp;'.$row['Last Name'];
                    $output .='</li>';
                    echo $output;
                    }
                }
            }else{
                echo '<span style="color:red;">Sorry, no users were found</span>';
            }
             ?>
            </ul>
      </div>
      <div class="col-md-8">
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="">
              <div class="card card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
      </div>
    </div>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>