<?php
session_start();
if(!isset($_SESSION['adminName'])){
       header("Location:index.php");
    }
include "../../dbConnection.php";
$conn = getDatabaseConnection("ottermart");

function getCategories() {
    global $conn;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
       // echo "<option>". $record['catName'] ." </option>";
        echo "<option value='".$record["catId"]."' >".$record["catName"]."</option>";
    }
}

if(isset($_GET['Create'])){
    $productName = $_GET['productName'];
    $productDescription = $_GET['description'];
    $productImage = $_GET['productImage'];
    $productPrice = $_GET['price'];
    $catId = $_GET['catId'];
    
    
    $sql = "INSERT INTO om_product
            ( `productName`, `productDescription`, `productImage`, `price`, `catId`) 
             VALUES ( :productName, :productDescription, :productImage, :productPrice, :catId)";
    
    $np = array();
    $np[':productName'] = $productName;
    $np[':productDescription'] = $productDescription;
    $np[':productImage'] = $productImage;
    $np[':productPrice'] = $productPrice;
    $np[':catId'] = $catId;
    
    $stm = $conn->prepare($sql);
    $stm->execute($np);
    
    header("Location: admin.php");
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add A Product </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style>
            form,h1,nav{
                text-align: center;
            }
             a{
                padding:7px;
            }

        </style>
    </head>
    <body>
        <nav>

          <a href="admin.php">Home</a>
          <a href="">Add New Product</a>
          <a href="logout.php">Logout</a>

        </nav>
        <h1> Add A Product</h1>
        <form>
            Product Name: <br><input type="text" name="productName"/><br><br>
            Description: <br><textarea name="description" row= 5 cols = 20 ></textarea/><br><br>
            Price: <br><input type="text" name="price"/><br><br>
            Category:
            <br><select name="catId">
                <option value="">Select</option>
                <?=getCategories()?>
            </select>
            
            <br><br>SetImageURL: <br><input type="text" name = "productImage"><br>
            <!--<input type="submit" name="submitProduct" value="Submit">-->
            <input type='submit' class='btn btn-success btn-sm' name='Create' value = 'Create' />
        </form>
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
    </body>
</html>