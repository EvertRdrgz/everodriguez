<?php

function checkComplete(){
    if (isset($_POST['schedule'])
    && isset($_POST['amount'])
    && isset($_POST['delivery'])
    && $_POST['contactName'] != ""
    && $_POST['contactEmail'] != ""
    ) { //if form was submitted

    $opponent = $_POST['schedule'];
    $numOfTickets = $_POST['amount'];
    $delivery_type = $_POST['delivery'];
    $name = $_POST['contactName'];
    $email= $_POST['contactEmail'];
    
    echo "Thank You, ".$name." for your purchase.</br>";
    echo "You Bought " .$numOfTickets." Tickets for the game against " . $opponent;
   
    
    if($opponent == "UCLA"){
        $price = 10;
    }
    elseif($opponent == "UCSC"){
        $price = 20;
    }
    else{
        $price = 5;
    }
    
    $total = $numOfTickets * $price;
    if($delivery_type == "print"){
        $total += $numOfTickets;
    }
    
    echo "</br>Subtotal: ".$total;
    echo "</br>Tax: ".$total * .0825;
    echo "</br>Total: ".$toal = $total + ($total * .0825);
    echo "</br>Your confirmation number is: ".mt_rand(1000,9999);
    
    
    
    if($delivery_type == "print"){
         echo "</br>Please check your email in order to print your ticket(s)";
    }
    elseif($delivery_type == "pickup"){
        echo "</br>Please arrive 30 minutes before the start of the game in order to pick up your ticket(s)";
    }

  }
  else{
      echo "Please Make Sure You have completed the form in order to continue.";
  }
    
}



function checkAmount($num){
    if ($num == $_POST['amount']) {
       echo " selected";
    }
    
}

?>
<!DOCTYPE html>
<html>
     <head>
        <title>Homework 3: Otter Baseball Tickets </title>
        <meta charset="utf-8"/>
    </head>
    
    <body>
        <h1>Otter Baseball Ticket Center</h1>
        
        <table>
            <tr>
                <th>Opponent</th>    
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>UCLA</td>
                <td>Home</td>
                <td>03/15/2018</td>
                <td>3pm</td>
                <td>$10</td>
            </tr>
             <tr>
                <td>UCSC</td>
                <td>Away</td>
                <td>03/17/2018</td>
                <td>12pm</td>
                <td>$20</td>
            </tr>
            <tr>
                <td>Hartnell</td>
                <td>Away</td>
                <td>03/20/2018</td>
                <td>3pm</td>
                <td>$5</td>
            </tr>
            
        </table>
        
        </br>
        For which game would you like tickets?
        
        <form method="POST" >
            
            <input type="radio" name="schedule" value="UCLA" id="schedule_ucla"
            <?php
            
              if($_POST['schedule']==UCLA){
                echo "checked";
              }
            ?>>
            <label for="schedule_ucla"> vs UCLA </label>
            </br><input type="radio" name="schedule" value="UCSC" id="schedule_ucsc"
            <?php
            
              if($_POST['schedule']==UCSC){
                echo "checked";
              }
            ?>>
            <label for="schedule_ucsc"> @ UCSC </label>
            </br><input type="radio" name="schedule" value="Hartnell" id="schedule_hartnell"
            <?php
            
              if($_POST['schedule']==Hartnell){
                echo "checked";
              }
            ?>>
            <label for="schedule_hartnell"> @ Hartnell </label>
       
        
        
        </br>
        How many tickets would  you like? Maximum of 5 tickets per purchase.
        </br>
            
             <select name="amount">
              <option value="" >  Select One </option> 
              <option value="1" <?=checkAmount(1)?>>  1 </option>
              <option value="2"  <?=checkAmount(2)?>> 2 </option>
              <option value="3"  <?=checkAmount(3)?>> 3 </option>
              <option value="4"  <?=checkAmount(4)?>>4 </option>
              <option value="5"  <?=checkAmount(5)?>>5 </option>
            </select>
            
        
        </br>
        Would you like to pick up tickets, or print at home?
       
            </br>
            <input type="radio" name="delivery" value="pickup" id="delivery_pick_up"
            <?php
            
              if($_POST['delivery']=="pickup"){
                echo "checked";
              }
             ?>>
            <label for="delivery"> Pick Up </label>
            </br><input type="radio" name="delivery" value="print" id="delivery_print"
            <?php
            
              if($_POST['delivery']=="print"){
                echo "checked";
              }
             ?>>
            <label for="delivery"> Print (This option includes a $1 convenice fee per ticket)</label>
      
        
            </br>
        
            <input type="text" size ="50" name="contactName" placeholder="Name" value="<?=$_POST['contactName']?>" />
            </br>
            <label for="contact"> Please Enter Your Name</label>
            </br>
            <input type="text" size ="50" name="contactEmail" placeholder="E-mail" value="<?=$_POST['contactEmail']?>" />
            </br>
            <label for="contact"> Please Enter Your E-mail</label>
            
            </br>
            <input type="submit" value="Submit"/>
        </form>
        
        <?=checkComplete()?>
        
        
    </body>
    
    <footer>
        
    </footer>
    
</html>
    
    
</DOCTYPE>