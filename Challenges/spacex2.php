<?php

    include "../dbConnection.php";
    $conn = getDatabaseConnection("SpaceX");

    function getPastFlights() {
        global $conn;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.spacexdata.com/v2/launches",
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
            $launch_rocket_success = $data[$i]['launch_success'];
            $launch_mission_patch = $data[$i]['links']['mission_patch'];
            $launch_article_link = $data[$i]['links']['article_link'];
            $launch_video_link = $data[$i]['links']['video_link'];

            //payload
            
            $payload = array();
            $payload = $data[$i]['rocket']['second_stage']['payloads'];
            
            $customerF = "";
            $itemF = "";
            foreach($payload as $pay){
                $customers = "";
                $items = "";
                $customers = $pay['customers'][0];
                $customerF .= $customers.'  ';
                $items = $pay['payload_type'];
                $itemF .= $items."  ";

            }

            
             $sql2 = "INSERT INTO `PAST`
            
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`, `flight_rocket_type`,`flight_success`,`flight_patch`,`flight_article`, `flight_video`,`flight_cargo`,`flight_customers`) 
             VALUES ( :flight_number, :flight_year, :flight_date, :flight_site, :flight_rocket_name, :flight_rocket_type,:flight_success ,:flight_patch ,:flight_article,:flight_video,:flight_cargo,:flight_customers)";
            
        
            $np = array();
            $np[':flight_number'] = $flight_number;
            $np[':flight_year'] = $launch_year;
            $np[':flight_date'] = $launch_time;
            $np[':flight_site'] = $launch_site;
            $np[':flight_rocket_name'] = $launch_rocket_name;
            $np[':flight_rocket_type'] = $launch_rocket_type;
            $np[':flight_success'] = $launch_rocket_success;
            $np[':flight_patch'] = $launch_mission_patch;
            $np[':flight_article'] = $launch_article_link;
            $np[':flight_video'] = $launch_video_link;
            $np[':flight_cargo'] = $itemF;
            $np[':flight_customers'] = $customerF;
            
            /*$stm = $conn->prepare($sql2);
            $stm->execute($np);*/
           
            $i++;
        }
        
    }
    
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
            
            $customerF = "";
            $itemF = "";
            foreach($payload as $pay){
                $customers = "";
                $items = "";
                $customers = $pay['customers'][0];
                $customerF .= $customers.'  ';
                $items = $pay['payload_type'];
                $itemF .= $items."  ";

            }

            
             $sql2 = "INSERT INTO `FUTURE`
            
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`, `flight_rocket_type`,`flight_cargo`,`flight_customers`) 
             VALUES ( :flight_number, :flight_year, :flight_date, :flight_site, :flight_rocket_name, :flight_rocket_type,:flight_cargo,:flight_customers)";
            
        
            $np = array();
            $np[':flight_number'] = $flight_number;
            $np[':flight_year'] = $launch_year;
            $np[':flight_date'] = $launch_time;
            $np[':flight_site'] = $launch_site;
            $np[':flight_rocket_name'] = $launch_rocket_name;
            $np[':flight_rocket_type'] = $launch_rocket_type;
            $np[':flight_cargo'] = $itemF;
            $np[':flight_customers'] = $customerF;
            
            $stm = $conn->prepare($sql2);
            $stm->execute($np);
           
            $i++;
        }
        
    }
    
    


?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?=getPastFlights()?>
        
        <h1>Now the upcoming flights</h1>
        
        <?=getFutureFlights()?>
        
    </body>
</html>