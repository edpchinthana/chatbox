<?php                            
    session_start();      
    include('includes/database.php');
    $username =$_GET['username'];
    $nameCount=0;
    $username=strtolower($username);
    //Create login query
    if($username!=""){
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
            //Display the entered username is available
            echo '<span style="color:rgb(7, 173, 2);">'."&nbsp;&nbsp;&nbsp;&nbsp;Username is available!".'</span>';	
        }else if($nameCount==1){
            //Display the entered username is not available
             echo '<span style="color:rgb(255, 0, 0);">'."&nbsp;&nbsp;&nbsp;&nbsp;Username is not available!".'</span>';	
        }
        }
        $_SESSION['nameChecked']=$nameCount;
    }
                                
       
?>