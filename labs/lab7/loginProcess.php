<?php
    session_start();
    
    
    print_r($_POST);
    
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    echo $password;
    $sql = "SELECT *
            FROM om_admin
            WHERE username = '$username' 
            AND password = '$password' ";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting only ONE record
    
    print_r($record);
    
    if(empty($record)){
        echo "Wrong username or password!";
    }else{
        //echo $record['firstName']." ".$record['lastName'];
        $_SESSION['adminName'] = $record['firstName']." ".$record['lastName'];
        header("Location:admin.php");
    }
?>