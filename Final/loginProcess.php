<?php
    session_start();
    
    //($_POST);
    
    include "../../dbConnection.php";
    include "header.php";
    $conn = getDatabaseConnection("heroku_17fba7f9655f376");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    

    //following code does prevent SQL injection
    $sql = "SELECT *
            FROM ADMIN
            WHERE username = :username 
            AND password = :password ";
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting only ONE record
    
    //print_r($record);
    
    if(empty($record)){
        echo "Wrong username or password!";
        echo "<form  action='adminLogin.php'>";
        echo "<input type='submit' value='Try Again'/>";
        echo "</form>";
        /*$_SESSION['successfulLogin'] = 'false';
        header("Location:index.php");*/
        
    }else{
        //echo $record['first_name']." ".$record['last_name'];
       $_SESSION['adminName'] = $record['first_name']." ".$record['last_name'];
        header("Location:admin.php");
    }
    
    include 'footer.php';
?>