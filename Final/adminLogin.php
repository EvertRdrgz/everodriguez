<?php
    
    include 'header.php';

    session_start();
    
    if(isset($_SESSION['adminName'])){
       header("Location:admin.php");
    }
?>

        <h1>SpaceX - Admin Login</h1>
        <form method="POST" action="loginProcess.php">
            
            Username <input type="text" name="username"/> <br><br>
            Password <input type="password" name="password"/> <br><br>
            
            <input type='submit' value = 'Login' />
        </form>
        
<?php
    include 'footer.php';
?>