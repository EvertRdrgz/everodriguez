<?php
    session_start();
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    include '../../dbConnection.php';
    
    
    $conn = getDatabaseConnection("Gamestore");
    
    function displayCategories(){
        global $conn;
        
        $sql="SELECT catId, catName FROM om_category ORDER BY catName";
        
        $stm = $conn->prepare($sql);
        $stm->execute();
        $records = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach($records as $record){
            echo "<option value='".$record["catId"]."' >".$record["catName"]."</option>";
        }
    }//end of displayCategories function
    
    
    function displaySearchResults(){
        global $conn;
        
        if(isset($_GET['searchForm'])){  //checks whether has input data
        
        echo "<h3> Prodcuts Found: </h3></br>";
        
        $namedParameters = array();
        
        $sql = "SELECT * FROM om_product WHERE 1";
        
        if(!empty($_GET['product'])){
            $sql .= " AND productName LIKE :productName ";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
        
        if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
            $sql .=  " AND catId = :categoryId";
            $namedParameters[":categoryId"] =  $_GET['category'];
        }
        
        if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
            
            $sql .=  " AND price >= :priceFrom";
            $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
        }
        
        if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
            
            $sql .=  " AND price <= :priceTo";
            $namedParameters[":priceTo"] =  $_GET['priceTo'];
        }
        
        if (isset($_GET['orderBy'])){
            if($_GET['orderBy'] == "price"){
                $sql .= " ORDER BY price";
            }
            else{
                $sql .= " ORDER BY productName";
            }
        }
        echo $sql;
                
        $stm = $conn->prepare($sql);
        $stm->execute($namedParameters);
        $records = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($records as $record){
            echo "<br><a href=\"purchaseHistory.php?productId=".$record["productId"]."\">History </a>";
            echo $record["productName"] . " " . $record["productDescription"] . " 
            $".$record['price']."<br />";
            }
            
        }
        
    }//end displaySearchResults
    
    
   
?>


<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Product Search</title>
    </head>
    <body>
        <h1>OtterMart Product Search</h1>
        
        <form>
            <br />
            Product: <input type="text" name="product" />
            
            <br />
            Category: 
            <select name="category">
                <option value="">Select One</option>
                <?=displayCategories()?>
            </select>
            <br />
            
            Price: From <input type="text" name="priceFrom" size=4 />
                    To <input type="text" name="priceTo" size=4 />
            
            <br />        
            Order results by:<br />
            
            <input type="radio" name="orderBy" value="price"/>Price<br />
            <input type="radio" name="orderBy" value="name"/>Name<br />
            
            <br />
             <input type="submit" value="Search" name="searchForm" />
            
        </form>
        
        <?= displaySearchResults()?>
        
    </body>
</html>