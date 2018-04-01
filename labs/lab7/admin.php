<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page</title>
    </head>
    <body>
        <h1>Admin Login Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3>
</html>