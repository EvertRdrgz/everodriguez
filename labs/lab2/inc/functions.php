<?PHP
    function displaySymbol($randomvalue,$pos){


        switch ($randomvalue) {
            case '0':
                 $symbol = "lemon";
                break;
            case '1':
                $symbol = "cherry";
                break;
            case '2':
                $symbol = "seven";
                break;
            case '3':
                $symbol = "grapes";
                break;
            default:
                $symbol = "csumb";
                break;
        }
        
        echo "<img id='reel$pos' src='img/$symbol.png' width='70' alt='$symbol' title=\"$symbol\"/>";
    }
    
    function displayPoints($randomvalue1, $randomvalue2, $randomvalue3){
        echo "<div id='output'>";
        if ($randomvalue1 == $randomvalue2 && $randomvalue2 == $randomvalue3){
            switch ($randomvalue1) {
                case '0': $toalPoints = 250;
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '1': $toalPoints = 750;
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '2': $toalPoints = 1000;
                          echo "<h1>Jackpot!</h1>";
                    break;
                case '3': $toalPoints = 900;
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
            ${"randomValue" . $i} = rand(0,3);
            displaySymbol(${"randomValue" . $i},$i);
        }
        displayPoints($randomValue1,$randomValue2,$randomValue3);
    
    }
?>