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
    
    echo "<p>Thank You, ".$name." for your purchase.</br>";
    echo "You Bought " .$numOfTickets." Tickets for the game against " . $opponent."</p>";
   
    
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
    
    echo "</br><p>Subtotal: ".$total;
    echo "</br>Tax: ".$total * .0825;
    echo "</br>Total: ".$toal = $total + ($total * .0825);
    echo "</br>Your confirmation number is: ".mt_rand(1000,9999);
    
    
    
    if($delivery_type == "print"){
         echo "</br>Please check your email in order to print your ticket(s)</p>";
    }
    elseif($delivery_type == "pickup"){
        echo "</br>Please arrive 30 minutes before the start of the game in order to pick up your ticket(s)</p>";
    }

  }
  else{
      echo '<p id="incomplete">Please Make Sure You Have Completed The Form In Order To Continue.</p>';
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
        <style>  @import url("css/styles.css");</style>
    </head>
    
    <body>
        <h1>Otter Baseball Ticket Center</h1>
        <hr width="75%" />
        
        <table id="table1" align="center">
            <tr>
                <th id="heading">Opponent</th>    
                <th id="heading">Location</th>
                <th id="heading">Date</th>
                <th id="heading">Time</th>
                <th id="heading">Price</th>
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
        <p id="heading"> For which game would you like tickets?</p>
        
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
        <p id="heading">How many tickets would  you like? Maximum of 5 tickets per purchase.</p>
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
       <p id="heading"> Would you like to pick up tickets, or print at home? </p>
       
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
            <label for="delivery"> Print (This option includes a $1 convenice fee per ticket) </br></label>
      
            </br>
            <input type="text" size ="50" name="contactName" placeholder="Name" value="<?=$_POST['contactName']?>" />
            </br>
            <label for="contact" id="heading"> Please Enter Your Name</label>
            </br>
            <input type="text" size ="50" name="contactEmail" placeholder="E-mail" value="<?=$_POST['contactEmail']?>" />
            </br>
            <label for="contact" id="heading"> Please Enter Your E-mail</label>
            
            </br>
            <input type="submit" value="Submit"/>
        </form>
        
        <?=checkComplete()?>
        
        <hr width="75%" />
    </body>
    
    <footer>
        CST336. 2018 Rodriguez &copy<br />
            <strong>Disclaimer:</strong> The informaiton in this webpage is fictitous.<br />
            It is used for academic purposes only.<br></br>
            <img id="csumbLogo" src="/everodriguez/img/csumb.png" alt="CSUMB logo." />
    </footer>
    
</html>
    
    
</DOCTYPE>