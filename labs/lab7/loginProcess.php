<?php
    session_start();
    
    
    //($_POST);
    
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
   // echo $password;
    
    //following code does not prevent SQL injection
    $sql = "SELECT *
            FROM om_admin
            WHERE username = '$username' 
            AND password = '$password' ";
    
    
    //following code does prevent SQL injection
    $sql = "SELECT *
            FROM om_admin
            WHERE username = :username 
            AND password = :password ";
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting only ONE record
    
    print_r($record);
    
    if(empty($record)){
        /*echo "Wrong username or password!";
        echo "<form  action='index.php'>";
        echo "<input type='submit' value='Try Again'/>";
        echo "</form>";*/
        $_SESSION['successfulLogin'] = 'false';
        header("Location:index.php");
        
    }else{
        //echo $record['firstName']." ".$record['lastName'];
        $_SESSION['adminName'] = $record['firstName']." ".$record['lastName'];
        header("Location:admin.php");
    }
?>