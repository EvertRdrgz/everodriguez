<!DOCTYPE html>
<html>
    <head>
        <title>Lab 2: 777 Slot Machine </title>
        <meta charset="utf-8"/>
    </head>

    <body>
        <?php
        
        function displaySymbol($randomvalue){
            //$randomvalue = rand(0,2); //inclusive
            echo "random value is: " . $randomvalue;
            
            switch ($randomvalue) {
                case '0':
                     $symbol = "lemon";
                    break;
                case '1':
                    $symbol = "orange";
                    break;
                case '2':
                    $symbol = "cherry";
                    break;
                default:
                    $symbol = "csumb";
                    break;
            }
            
            echo "<img src='img/$symbol.png' width='70' alt='$symbol' title=\"$symbol\"/>";
        }
        
        function displayPoints($randomvalue1, $randomvalue2, $randomvalue3){
            if ($randomvalue1 == $randomvalue2 && $randomvalue2 == $randomvalue3){
                switch ($randomvalue1) {
                    case '0': $toalPoints = 1000;
                              echo "<h1>Jackpot!</h1>";
                        break;
                    case '1': $toalPoints = 500;
                              echo "<h1>Jackpot!</h1>";
                        break;
                    case '2': $toalPoints = 250;
                              echo "<h1>Jackpot!</h1>";
                        break;
                }
                echo "<h2>You won $toalPoints points!</h2>";
            }else{
                echo "<h3>Try again!</h3>";
            }
        }
        
        $randomvalue1 = rand(0,2);
        displaySymbol($randomvalue1);
        $randomvalue2 = rand(0,2);
        displaySymbol($randomvalue2);
        $randomvalue3 = rand(0,2);
        displaySymbol($randomvalue3);
        displayPoints($randomvalue1,$randomvalue2,$randomvalue3);
        
        echo "<br/><hr> Values: $randomvalue1 $randomvalue2 $randomvalue3"
        
        // for($i=0; $i < 3; $i++){
        //     displaySymbol();
        // }
            
        ?>
        <!--
        <img src="img/grapes.png" width="70" alt="grapes" title="grapes"/>
        <img src="img/cherry.png" width="70" alt="cherry" title="cherry"/>
        <img src="img/orange.png" width="70" alt="orange" title="orange"/>
        -->

    </body>
</html>