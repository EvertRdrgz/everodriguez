<?php

function getLatestFlight() {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.spacexdata.com/v2/launches/latest",
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
    
    //print_r($data);
    $launch_time = $data['launch_date_local'];
    $launch_site = $data['launch_site']['site_name_long'];
    $launch_rocket_type = $data['rocket']['rocket_name'];
    $launch_succes = $data['launch_success'];
    $launch_video = $data['links']['video_link'];
    echo "The Latest launch was on: " . $launch_time . "<br> It was a ".$launch_rocket_type." from ".$launch_site."<br> Here is the video link: <br>".$launch_video;
   
    //echo "The latest launch was on: ".$launch_time;
    //echo "</br> It was a: ".$launch_rocket_type;
}

?>

<!DOCTYPE html>
<html>
    
    <body>
        <?php getLatestFlight() ?>
    </body>
</html>


