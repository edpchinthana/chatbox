
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
                <h3 class="text-center">Please login to chat</h3>
                <a class="btn btn-warning  w-50 mx-auto " href="login.php">Login</a>
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
