
<?php

    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");

    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catName FROM `om_category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option>" . $record["catName"] . "</option>";
            
        }
        
    }
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>"; 
            
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            
            //Query below prevents SQL Injection
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  "AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
                    
            
            
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($records as $record) {
            
                 echo  $record["productName"] . " " . $record["productDescription"] . "<br />";
            
            }
        }
        
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Product Search </title>
    </head>
    <body>

        <h1>  OtterMart Product Search </h1>
        
        <form>
            
            Product: <input type="text" name="product" /><br />
            
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select>
            <br />
            
            Price:  From <input type="text" name="priceFrom" size="7"/>
                    To   <input type="text" name="priceTo" size="7"/>
                    
            <br />
            
             Order result by:<br />
             
             <input type="radio" name="orderBy" value="price"/> Price <br />
             <input type="radio" name="orderBy" value="name"/> Name
             
             <br />
             <input type="submit" value="Search" name="searchForm" />
             
        </form>
        
        <br />
        <hr>
        
        <?= displaySearchResults() ?>

    </body>
</html>