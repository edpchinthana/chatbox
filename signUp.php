<?php                            
    session_start();      
    include('includes/database.php');
    $username =$_GET['username'];
    $firstName =$_GET['firstName'];
    $lastName =$_GET['lastName'];
    $password2 =$_GET['password2'];
    $rePassword2 =$_GET['rePassword2'];
    $email=$_GET['username'];




    $nameCount=0;
    $username=strtolower($username);
    if($username!=""&&$firstName!=""&&$lastName!=""&&$password2!=""&&$rePassword2!=""){
      //Create check name query
    $query="SELECT username FROM users;"; 
    //Get results
    $result=$mysqli->query($query);
    //Check if the end of the results
    if($result->num_rows>=0){
    //Loop through results
        while($row = $result->fetch_assoc()){
            if($row['username']==$username){
                $nameCount=1;
            }
        }
        if($nameCount==0){
            //Proceed to login
            if($password2==$rePassword2){
               //Create check name query
              $query="INSERT INTO `users` (`first_name`, `last_name`, `email`,`username`, `password`) VALUES ('$firstName', '$lastName', '$email', '$username', '$password2');"; 
              //Run query
               $result=$mysqli->query($query);

               //Create table
               $query1="CREATE TABLE `$username` (`id` int(6) NOT NULL ,`chatPartner` int(6) NOT NULL,`type` int(1) NOT NULL DEFAULT '0',`message` varchar(200) NOT NULL,`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
               //Run query1
               $result=$mysqli->query($query1);

               //Create primary key
               $query2="ALTER TABLE `$username` ADD PRIMARY KEY (`id`), ADD KEY `chatPartner` (`chatPartner`);";
                //Run query3
                $result=$mysqli->query($query2);

              //Create foreign key
              $query3="ALTER TABLE `$username` ADD  CONSTRAINT `$username _ibfk_1` FOREIGN KEY (`chatPartner`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
              //Run query3
              $result=$mysqli->query($query3);
              
              //private table id auto increment
              $query4="ALTER TABLE `$username` CHANGE `id` `id` INT(6) NOT NULL AUTO_INCREMENT;";
              //Run query4
              $result=$mysqli->query($query4);
              
              echo "<span style='color:rgb(0, 81, 255);'>Registration process is completed. Please login and enjoy Lets chat</span>";
              echo "<script type='text/javascript'>document.getElementById('firstName').value='';</script>";
              echo "<script type='text/javascript'>document.getElementById('lastName').value='';</script>";
              echo "<script type='text/javascript'>document.getElementById('email').value='';</script>";
              echo "<script type='text/javascript'>document.getElementById('username2').value='';</script>";
              echo "<script type='text/javascript'>document.getElementById('password2').value='';</script>";
              echo "<script type='text/javascript'>document.getElementById('rePassword2').value='';</script>";



            }else{
              echo '<span style="color:rgb(255, 0, 0);">'."&nbsp;&nbsp;&nbsp;&nbsp;Entered passwords did not match".'</span>';
            }
            	
        }else if($nameCount==1){
            //Display the entered username is not available
             echo '<span style="color:rgb(255, 0, 0);">'."&nbsp;&nbsp;&nbsp;&nbsp;Username is not available!".'</span>';	
        }
        }
        
        
    }else{
      echo '<span style="color:rgb(255, 0, 0);">'."&nbsp;&nbsp;&nbsp;&nbsp;All fields should be filled".'</span>';
    }
       
    

       
?>