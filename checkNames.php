<?php                            
    session_start();      
    include('includes/database.php');
    $username =$_POST['username'];
    $username="user";
    $nameCount=0;
    echo "$username";
    //Create login query
    $query="SELECT username FROM users;"; 
    //Get results
    $result=$mysqli->query($query);
    //Check if the end of the results
    if($result->num_rows>0){
    //Loop through results
        while($row = $result->fetch_assoc()){
            if($row['username']==$username){
                $nameCount=1;
            }
        }
        if($nameCount==0){
            //Printing the error
            echo '<br><span style="color:rgb(7, 173, 2);">'."&nbsp;&nbsp;&nbsp;&nbsp;Available!".'</span>';	
        }else if($nameCount==1){
            //If the username and password are matched then proceed to menu.php
             echo '<br><span style="color:rgb(255, 0, 0);">'."&nbsp;&nbsp;&nbsp;&nbsp;Name is not available!".'</span>';	
        }
        }
                                
       
?>