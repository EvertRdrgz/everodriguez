<?php
include "../dbConnection.php";
$conn = getDatabaseConnection("heroku_17fba7f9655f376");

function getFutureFlights(){
        global $conn;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.spacexdata.com/v2/launches/upcoming",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));
        
        $jsonData = curl_exec($curl);
        $data = json_decode($jsonData, true); //true makes it an array!
        
        $err = curl_error($curl);
        curl_close($curl);
        
        $i = 0;
        while ($i < count($data)){
            
            $flight_number = $data[$i]['flight_number'];
            $launch_year = $data[$i]['launch_year'];
            $launch_time = $data[$i]['launch_date_local'];
            $launch_site = $data[$i]['launch_site']['site_name_long'];
            $launch_rocket_name = $data[$i]['rocket']['rocket_name'];
            $launch_rocket_type = $data[$i]['rocket']['rocket_type'];

            //payload
            
            $payload = array();
            $payload = $data[$i]['rocket']['second_stage']['payloads'];
            
            $launch_total_weight = 0;
            
            $customerF = "";
            $itemF = "";
            foreach($payload as $pay){
                $customers = "";
                $items = "";
                $customers = $pay['customers'][0];
                $customerF .= $customers.'  ';
                $items = $pay['payload_type'];
                $itemF .= $items."  ";
                $launch_total_weight += $pay['payload_mass_lbs'];

            }

            
             $sql2 = "INSERT INTO `future`
            
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`, `flight_rocket_type`,`flight_cargo`,`flight_customers`,`cargo_weight`) 
             VALUES ( :flight_number, :flight_year, :flight_date, :flight_site, :flight_rocket_name, :flight_rocket_type,:flight_cargo,:flight_customers,:cargo_weight)";
            
        
            $np = array();
            $np[':flight_number'] = $flight_number;
            $np[':flight_year'] = $launch_year;
            $np[':flight_date'] = $launch_time;
            $np[':flight_site'] = $launch_site;
            $np[':flight_rocket_name'] = $launch_rocket_name;
            $np[':flight_rocket_type'] = $launch_rocket_type;
            $np[':flight_cargo'] = $itemF;
            $np[':flight_customers'] = $customerF;
            $np[':cargo_weight'] = $launch_total_weight;
            
            $stm = $conn->prepare($sql2);
            $stm->execute($np);
           
            $i++;
            
            
        }
        
        echo "calling future funnction";
        
    }
?>

<!DOCTYPE html>
<html>
    
    <body>
        <?php getFutureFlights() ?>
    </body>
</html>


