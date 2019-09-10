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
            <li role="presentation"><a href="login.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Chat Room</h3>
      </div>
    </div>

	<!--Body-->
      <div class="container jumbotron">
       <div class=" col-xs-12">
        <br>
        <div id="show">
          <?php
          $scrollCounter=0;
          $_SESSION['varname4']=$scrollCounter;
          ?>
        </div>
        
        <br>
       </div>
       
      </div>
      </div>
      <div class="jumbotron fixed-bottom p-4 m-0" style="background-color:rgb(243, 237, 150)">
            <form role="form" method="" action="">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-xs-10">
                        <input name="text" id="message" type="text" class="form-control" placeholder="Enter your message">
                        </div>
                        <div class="col-xs-2">
                        <button type="button" id="send" class="btn btn-warning btn-block" onclick="insertData()">Send</button>
                    </div>
                        </div>
                    </div>
                    
                </form>
      </div>
	<!--Footer-->
      <footer class="footer">

      </footer>

      
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Auto refresh function (Interval - 1000)-->
    <script type="text/javascript">
      $(document).ready(function(){
        setInterval(function(){
          $('#show').load('refresh.php')
        },1000);
      });
    </script>

    <!--Send messages when click send button-->
    <script type="text/javascript">
      function insertData() {
        var message=$("#message").val();    
    // AJAX code to send data to php file.
    $.ajax({
                type: "POST",
                url: "sendMsg.php",
                data: {message:message},
                dataType: "JSON",
                success: function(data) {
                 $("#message").html(data);
                $("p").addClass("alert alert-success");
                }
            });
            //This is to refresh page after send a message
            $('#show').load('afterSend.php');
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
    </script>

  </body>
</html>
