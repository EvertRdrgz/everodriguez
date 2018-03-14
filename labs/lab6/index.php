<?php
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");
    
    function displayCategories(){
        global $conn;
        
        $sql="SELECT catName FROM om_category ORDER BY catName";
        
        $stm = $conn->prepare($sql);
        $stm->execute();
        $records = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach($records as $record){
            echo "<option>".$record["catName"]."</opiton>";
        }
    }//end of displayCategories function
    
    
    function displaySearchResults(){
        global $conn;
        
        if(isset($_GET['searchForm'])){  //checks whether has input data
        
        echo "<h3> Prodcuts Found: </h3></br>";
        
        
        $sql = "SELECT * FROM om_product WHERE 1
                AND productName LIKE '%".$_GET['product']."%' ";
                
                
        $stm = $conn->prepare($sql);
        $stm->execute();
        $records = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($records as $record){
             echo  $record["productName"] . " " . $record["productDescription"] . "<br />";
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
            Category 
            <select name="category">
                <option value="">Select One</option>
                <?=displayCategories()?>
            </select>
            <br />
            
            Price: From <input type="text" name="priceFrom"/>
                    To <input type="text" name="priceTo"/>
            
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