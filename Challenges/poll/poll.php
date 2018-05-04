<?php

session_start();

if(isset($_GET['answers'])){
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

        <script>
        
        function updatePoll() {
            
            var choice = " ";
            if($('#yes').is(':checked')){
                choice = "yes";
            }else if ($('#no').is(':checked')){
                choice = "no";
            }else{
                choice = 'maybe';
            }
            
            $("#container").html("<img src='img/loading.gif' />");
            
            //Include here the AJAX call
            $.ajax({

                type: "GET",
                url: "poll.php",
                dataType: "JSON",
                data:{"answer":$('#choice').val()},
                success: function(data,status) {
                //alert(data);
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
            
            });//ajax
            //on Success, call the 'updatePollChart' function passing the percentages of the three choices, for example:
            updatePollChart(25,40,35);
        }
        
        //You can change the choice names if different from "yes", "maybe", and "no"
        function updatePollChart(yes, maybe, no) {
            Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Choices',
                        colorByPoint: true,
                        data: [{
                            name: 'Yes',
                            y: yes
                        }, {
                            name: 'Maybe',
                            y: maybe,
                            sliced: true,
                            selected: true
                        }, {
                            name: 'No',
                            y: no
                        }]
                    }]
                });
        }//endFunction
        
        </script>
        
    </head>
    <body>

      <h1> Did you enjoy your semester </h1>
      <form id='answers'>
          <input type="radio" name="choice" value="yes" id="yes">Yes</input>
          <input type="radio" name="choice" value="no" id="no">No</input>
          <input type="radio" name="choice" value="maybe" id="maybe">Maybe</input>
      </form>
     
      <button onclick="updatePoll()">Submit</button>
      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

    </body>
</html>