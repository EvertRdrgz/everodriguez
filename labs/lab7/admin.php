<?php
    session_start();
    
    if(!isset($_SESSION['adminName'])){
       header("Location:index.php");
    }
    
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
     
    function displayAllProducts(){
        global $conn;
        $sql = "SELECT * FROM om_product";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($record);
        
        return $record;
    }
    
   
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style>
            nav,h1,h3,h4{
                text-align: center;
            }
            a{
                padding:7px;
            }
            form{
                display:inline;
                text-align: center;
                padding-left:600px;;
            }
            p{
                padding-left:600px;
                padding-top:6px;
            }

        </style>
        
        <script>
            
            function confirmDelete(){
                return confirm ("Are you sure you want to delete item?");
                
            }
        </script>
    </head>
    <body>
            
        <nav>

          <a href="">Home</a>
          <a href="addProduct.php">Add New Product</a>
          <a href="logout.php">Logout</a>

        </nav>
        
        <h1>Admin Login Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3>
        
        <br/>
       
        <strong><h4>Products:</h4></strong><br/>
        <p>
        
        <?php $records=displayAllProducts();
            foreach($records as $record) {
   
                //echo "<img src=".$record['productImage']." width='100' height='100'>";
                echo "<br><p class='record'><strong>".$record['productName']."</strong><br><img src=".$record['productImage']." width='100' height='100'></p>";
                
                echo "<form action='updateProduct.php'>"; 
                echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
                echo "<input type='submit' class='btn btn-primary btn-sm' value = 'Update' />";
                echo "</form><br>";
                
                
                
                echo "<form action='deleteProduct.php' onsubmit = 'return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
                echo "<input type='submit' class='btn btn-danger btn-sm' value = 'Remove' />";
                echo "</form>";
                
                
                echo '<br><br>';
                
            }
        
        ?>
        </p>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
    </body>
</html>