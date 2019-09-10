<!--Security system-->
<?php
 $count=0;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Let's Chat</title>
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
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="login.php">Login</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Home</h3>
      </div>

	<!--Body-->
      <div class="jumbotron">
        <h1 class="text-center">Lets Chat</h1>
        <div class="row">
                <div class="col-xs-12 col-md-4"></div>
                <div class="card border-warning col-xs-12 col-md-4">
                <form role="form" method="post" action="login.php">
                    <div class="form-group">
                        <br>
                        <label>Username</label>
                        <input name="username" type="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label><br>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-warning w-50 mx-auto" value="Login"/>
                    <?php
                        include('includes/database.php');
                        session_start();
                        $username="dasdad";
                        $userid="999";
                        
		            	if($_POST){
                    //submitting values
			            	$username =$_POST['username'];
				            $password =$_POST['password'];
				            $count=0;
	
			        	//Create login query
			            	$query="SELECT password,id FROM users where name='$username';"; 
			        	//Get results
				            $result=$mysqli->query($query);
			        	//Check if the end of the results
			            	if($result->num_rows>0){
			            		//Loop through results
			            		while($row = $result->fetch_assoc()){
			        			if($row['password']==$password){
                                  $count=1;
                                  $userid=$row['id'];
				        	}
			        	}
			        	if($count==0){
				        	//Printing the error
			        		echo '<br><span style="color:red;">'."<br>Incorrect username or password.".'</span>';	
			        	}else if($count==1){
			        		//If the username and password are matched then proceed to menu.php
			        		$count=3;
			        		header("Location:chatroom.php");
			        		}
			            	}
		            	else{
			        	//Printing the error
			        	echo '<span style="color:red;">'."Incorrect username or password.".'</span>';
		        	}
		    	}
			//Passing the count to next page-for security
            $_SESSION['varname1']=$count;
            $abc=strtolower($username);
            $_SESSION['varname2']=$abc;
            $_SESSION['varname3']=$userid;
		?>    
                </form>
                
                <br>
            </div>
        </div>
      </div>
	<!--Footer-->
      <footer class="footer">
        <p>&copy; 2019 Project01.</p>
      </footer>

    </div>   
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
