<!--Security system-->
<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap2.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
        <h3 class="text-muted">Home  
        </h3>
      </div>

	<!--Body-->
      <div class="jumbotron">
        <h1 class="text-center">Lets Chat</h1>
        <div class="row">
          <!--Collapse menu-->
            <div class=" col-xs-12" id="accordion">

              <!--Login collapse-->
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h3 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Already member? Click here to Login
                      </button>
                    </h3>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-4"></div>
                            <div class="card border-warning col-xs-12 col-md-4">
                            <form id="loginForm" role="form" method="post" action="">
                                <div class="form-group">
                                    <br>
                                    <label>Username</label>
                                    <input name="username" type="username" class="form-control" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label><br>
                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                <input type="submit" class="btn btn-warning w-25 mx-auto float-right" value="Login"/>
                                <?php
                                    include('includes/database.php');
                                    
                                    $username="test";
                                    $userid="999";
                                    $firstName="test";
                                    $lastName="test";

                                    
                              if($_POST){
                                //submitting values
                                $username =$_POST['username'];
                                $password =$_POST['password'];
                                $count=0;
              
                            //Create login query
                                $query="SELECT password,id,first_name,last_name FROM users where username='$username';"; 
                            //Get results
                                $result=$mysqli->query($query);
                            //Check if the end of the results
                                if($result->num_rows>0){
                                  //Loop through results
                                  while($row = $result->fetch_assoc()){
                                if($row['password']==$password){
                                              $count=1;
                                              $userid=$row['id'];
                                              $firstName=$row['first_name'];
                                              $lastName=$row['last_name'];
                              }
                            }
                            if($count==0){
                              //Printing the error
                              echo '<br><span style="color:red;">'."<br>Incorrect username or password.".'</span>';	
                            }else if($count==1){
                              //If the username and password are matched then proceed to home.php
                              $count=3;
                              header("Location:home.php");
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
                        $_SESSION['varname4']=$firstName;
                        $_SESSION['varname5']=$lastName;
                ?>    
                        </form>
                            
                            <br>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>

                <!--SignUp Collapse-->
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        New member? Click here to SignUp
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-1"></div>
                            <div class="card border-warning col-xs-12 col-md-10 ">
                            <form role="form" method="" action="">
                              <br>
                              <div class="row">
                                <div class="form-group col-md-6">
                                  
                                    <label>First Name</label>
                                    <input id="firstName" type="text" class="form-control" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                    
                                    <label>Last Name</label>
                                    <input id="lastName" type="Text" class="form-control" placeholder="Last Name">
                                </div></div>
                                <div class="form-group">
                                    
                                    <label>Email Address</label>
                                    <input id="email" type="email" class="form-control" placeholder="Email Address">
                                </div>
      
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="row">
                                    <div class="col-md-6">
                                    <input id="username2" name="username2" type="username" class="form-control" placeholder="Username">
                                  </div>
                                <input type="button" name="check" class="col-md-2 btn btn-success" onclick="checkNames();" value="Check"/>
                                <div class="col-md-4" id="showName">

                                </div>  
                              
                            </div></div>
                              <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input id="password2" type="password" class="form-control" placeholder="Password">
                                </div></div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Re-Type Password</label>
                                        <input id="rePassword2" type="password" class="form-control" placeholder="Password">
                                    </div></div>
                                <input type="button" class="btn btn-warning w-25 mx-auto float-right" onclick="signUp();" value="SignUp"/>  
                            </form>
                            
                            <br>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>
      </div>
	<!--Footer-->
      <footer class="footer">
        <p>&copy; 2019 Project01.</p>
      </footer>

    </div>   


    <!--Checks the entered username is available in the database-->
    <script type="text/javascript">
        function checkNames() {
        var username3=$("#username2").val();          
         $('#showName').load('checkNames.php?username='+username3);
    }
    </script>


    <!--Check the name is available and passwords are matched then proceed to create new user account-->
    <script type="text/javascript">
    function signUp(){
      var firstName=$("#firstName").val();
      var lastName=$("#lastName").val();
      var email=$("#email").val();
      var username2=$("#username2").val();
      var password2=$("#password2").val();
      var rePassword2=$("#rePassword2").val();

    }
    </script>


  </body>
</html>
