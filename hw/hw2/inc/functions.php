<?PHP
    function displaySymbol($randomvalue,$pos){

        $symbols = array("android","apple","css","html","instagram","linux","otter","php","twitter","windows");
        
        $randomSymbol = $symbols[$randomvalue];
        
        echo "<img id='reel$pos' src='img/$randomSymbol.png' width='70' alt='$randomSymbol' title=\"$randomSymbol\"/>";
    }
    
    function displayPoints($randomvalue1, $randomvalue2, $randomvalue3){
        echo "<div id='output'>";
        if ($randomvalue1 == $randomvalue2 && $randomvalue2 == $randomvalue3){
            switch ($randomvalue1) {
                case '0': $toalPoints = 100;  //android
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '1': $toalPoints = 250; //apple
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '2': $toalPoints = 500;//css
                        echo "<h1>Jackpot!</h1>";
                    break;    
                case '3': $toalPoints = 750;//html
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '4': $toalPoints = 1000;//instagram
                        echo "<h1>Jackpot!</h1>";
                    break;
                case '5': $toalPoints = 10000;//linux
                        echo "<h1>Jackpot!</h1>";
                    break;
                case '6': $toalPoints = 100000000;//otter
                        echo "<h1>Jackpot!</h1>";
                    break;
                case '7': $toalPoints = 50000;//php
                        echo "<h1>Jackpot!</h1>";
                    break;
                case '8': $toalPoints = 100000;//titter
                        echo "<h1>Jackpot!</h1>";
                    break;
                case '9': $toalPoints = 1000000;//windows
                        echo "<h1>Jackpot!</h1>";
                    break;    
            }
            
            echo "<h2>You won $toalPoints points!</h2>";
        }else{
            echo "<h3>Try again!</h3>";
        }
        echo "</div>";
    }
    
    function play(){
        for ($i=1; $i<4; $i++){
            ${"randomValue" . $i} = rand(0,9);//# of pic - 1
            displaySymbol(${"randomValue" . $i},$i);
        }
        displayPoints($randomValue1,$randomValue2,$randomValue3);
    
    }
?>