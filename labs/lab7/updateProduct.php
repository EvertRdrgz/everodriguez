<?php
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    function getCategories($catId) {
        global $conn;
        
        $sql = "SELECT catId, catName from om_category ORDER BY catName";
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($record['catId'] == $catId)? "selected": "";
            echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
            
        }
    }
    
    function getProductInfo(){
        
        $sql = "SELECT * FROM om_product WHERE productId = " .$_GET['productId'];
        
        //echo $_GET["productId"];
        global $conn;
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
        
    }
    
    if (isset($_GET['updateProduct'])){
        
        //echo "Trying to update the product";
        
        $sql = "UPDATE om_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                WHERE productId = :productId";
                
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":productDescription"] = $_GET['description'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
        
        
        $statement = $conn->prepare($sql);
        $statement->execute($np);
        
        header("Location: admin.php");
    }
    
    if(isset($_GET['productId'])){
        $product = getProductInfo();
    }
    //print_r($product);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Product </title>
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
          <a href="addProduct.php">Add New Product</a>
          <a href="logout.php">Logout</a>

        </nav>
        <h1>Update Product</h1>
        
        <form>
            <input type="hidden" name="productId" value ="<?=$product['productId']?>"/>
            Product name: <br><input type="text" value = "<?=$product['productName']?>" name="productName"><br><br>
            Description: <br><textarea name="description" cols = 20 rows = 4> <?= $product['productDescription'] ?> </textarea><br><br>
            Price: <br><input type="text" name="price" value="<?=$product['price']?> "><br><br>
            Category: <br><select name="catId">
                <option value="">Select One</option>
                <?php getCategories($product['catId']); ?>
            </select> <br /><br>
            Set Image Url: <br><input type = "text" name = "productImage" value="<?=$product['productImage']?> "><br><br>
            <!--<input type="submit" name="updateProduct" value="Update Product">-->
            <input type='submit' class='btn btn-success btn-sm' name='updateProduct' value = 'Update' />
            
        </form>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
    </body>
</html>