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
include('includes/database.php');
 //query to import user details
  $query="SELECT first_name, last_name from users where id=$userid;";
  $result=$mysqli->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $firstName=$row['first_name'];
                $lastName=$row['last_name'];
            }
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
            <li role="presentation"><a href="index.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Hello
            <?php echo $firstName; ?> 
        </h3> 
    </div>

    <div>
        <div class="position-sticky m-0 col-sm-5 col-md-3" style="top: 5px;">
            <!--Users List-->
              <ul class="list-group">
                 <li class="list-group-item bg-warning "><h4>
                    Chat</h4>
                 </li>
                 <!--Importing users to an unordered list-->
                 <?php
                  
                  //Create login query        
                    $query="SELECT first_name as 'First Name' , last_name as 'Last Name', id as 'id' from users;"; 
                  //Get results
                  $result=$mysqli->query($query);
                  if($result->num_rows>0){
                    //Loop through results
                    while($row=$result->fetch_assoc()){
                        //Display student info   
                        if($row['id']!=$userid){
                        $output  ='<li class="list-group-item bg-light"><input id="'.$row['id'].'" class="btn btn-block" type="button"  value="';
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
    <div class="row">
      <!--Message Viewer-->
          <div class="container bg-light" id="showChats">
              <?php
              $scrollCounter=0;
              $_SESSION['varname6']=$scrollCounter;
              ?>
          
      </div>
    </div>

          <!--To avoid the overlap in mobile view-->
          <div class="jumbotron jumbotron-fluid p-5 m-5">
            </div>

    </div>
          <!--Fixed div includes form - send messages-->
          <div class="jumbotron fixed-bottom p-4 m-0" style="background-color:rgb(243, 237, 150)">
              <form role="form" id="sendForm" method="" action="">
                      <div class="form-group">
                          <div class="row">
                          <div class="col-xs-10">
                          <input name="text" id="message" type="text" class="form-control" placeholder="Enter your message">
                          </div>
                          <div class="col-xs-2">
                          <button type="button" id="send" class="btn btn-warning btn-block" onclick="insertData(); document.getElementById('message').value='';">Send</button>
                      </div>
                          </div>
                      </div>
                      
                  </form>
        </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Send messages when click send button-->
    <script type="text/javascript">
    var chatPartner=0;
      function importChats(x) {   
         chatPartner = x;
        // console.log(chatPartner);
        //This is to refresh page after send a message
        $('#showChats').load('importChats.php?cp='+chatPartner);
    }
    </script>
        <!--Send messages when click send button-->
        <script type="text/javascript">
          function insertData() {
            var message=$("#message").val();   
            var messageEncoded= encodeURI(message);
            //This is to refresh page after send a message
            $('#showChats').load('sendMsg.php?msg='+messageEncoded+'&cp='+chatPartner);
                //console.log(messageEncoded);
                //console.log(chatPartner);
        }
        
        </script>
    
        <!--When press enter send messages-->
        <script>
        $(document).ready(function(){
        $('#message').keypress(function(e){
          if(e.keyCode==13)
          $('#send').click();
        });
        });
        $("#sendForm").submit(function(e) {
        e.preventDefault();
    });
        </script>
    
    <!--Auto refresh function (Interval - 1000)-->
    <script type="text/javascript">
      
      $(document).ready(function(){
        setInterval(function(){
          if(chatPartner!=0){
          $('#showChats').load('refreshChat.php?cp='+chatPartner);}
        },1000);
      });
      
    </script>
    </body>
</html>