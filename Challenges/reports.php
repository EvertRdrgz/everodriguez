
<?php
     
     
     
     
     
     /*
      
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

  
    
    */
    
    
    
$sql1 = "SELECT COUNT(1) totalPurchases
            FROM om_purchase p
            INNER JOIN om_user u
            on p.user_id = u.userId
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
$sql2 = "SELECT productName
            FROM om_user u
            INNER JOIN om_purchase p
            on u.userId = p.user_id
            NATURAL JOIN om_product
            WHERE email LIKE \"%@aol.com\" ";
            
$sql3 = "SELECT SUM(quantity), sex
            FROM om_user u
            INNER JOIN om_purchase p
            on u.userId = p.user_id
            GROUP BY sex";

$sql4 = "SELECT DISTINCT(catName)
            FROM purchase p
            INNER JOIN user u
            on p.user_id = u.userId
            NATURAL JOIN product 
            NATURAL JOIN category cat
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
$host = "localhost";
$dbname= "ottermart";
$username = "root";
$password = "";


$dbConn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$stmt = $dbConn->prepare($sql1);
$stmt->execute();
$records = $stmt->fetch(); 



echo "Total Purchases in February: " .$records['totalPurchases']."<br>";

$stmt = $dbConn->prepare($sql2);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($records);
echo "Items bought by AOL users: <br>";

foreach ($records as $record) {
    // code...
    echo $record['productName']."<br>";
}

$stmt = $dbConn->prepare($sql3);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($records);

foreach ($records as $record) {
    // code...
    echo $record['sex'].": ".$record['SUM(quantity)']."<br>";
}

?>