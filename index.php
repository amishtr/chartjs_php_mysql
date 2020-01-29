<?php

/**
 * Filename: index.php
 * Description: Weekly Registered New Users Dashboard
 * Author: Amish Trivedi
 * Date developed: 27-Jan-2019
 * Version: 1.0
 */

?>
<!DOCTYPE html>
<html>
<head>

<!-- refresh page every 5 minutes -->
<meta http-equiv="refresh" content="300">

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<title>Weekly Registered Users - Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/line-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- sorting for tables -->
<script src="js/sorttable.js"></script>

<!-- Bootstrap select -->
<link rel="stylesheet" href="css/bootstrap-select.min.css">
<script src="js/bootstrap-select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<style>
  body 
  {
    background-color: white;
  }
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">  
  <div class="collapse navbar-collapse" id="navb">
    <ul class="navbar-nav mr-auto">
    </ul>
  <span class="navbar-brand"><h2 class="font-weight-bold" style="margin-bottom: 0;text-shadow: 2px 2px black;">Weekly Registered New Users Dashboard</h2></span>
    <form class="form-inline my-2 my-lg-0" action="" method="get" id="">
      <button class="btn btn-success my-3 my-sm-0" type="submit"><i class="la la-refresh"></i>&nbsp;Refresh</button>
    </form>
  </div>  <!-- navbar -->
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1 card-4" style="z-index: -1;">
   <ul class="navbar-nav mr-auto">
   </ul>
   <span><b>Data as of: <?php echo date("d-M-Y, H:i");?> (Auto-Refresh every 5 minutes)</b></span>
</nav>
<br>
<br><br>

<div class="container">
<canvas id="mycanvas" height = "565" width="900"></canvas>
</div> <!-- container -->
<br><br>

<script>
$(document).ready(function(){
  $.ajax({
    url: "data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var weeks = [];
      var users = [];

      for(var i in data) {
        weeks.push("Week No. " + data[i].Week);
        users.push(data[i].Users);
      }

      var chartdata = {
        labels: weeks,
        datasets : [
          {
            label:'Registered Users' ,
            backgroundColor: "#4E5D6C",
            borderColor: "#4E5D6C",
            hoverBackgroundColor: "#DC143C",
            hoverBorderColor: "#DC143C",
            data: users
          },
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
        options: {
          legend: {
            display: true
         },
          tooltips: {
            enabled: true
         },
        scales: {
            xAxes: [{
              scaleLabel: {
              display:'true', 
              fontSize:16, 
              labelString:'Number of Weeks',
              fontStyle: "bold"
             }, 
            }],
            yAxes: [{
              scaleLabel: {
              display:'true', 
              fontSize:16, 
              labelString:'Number of Users Registered',
              fontStyle: "bold"
             }, 
             ticks: {
                 beginAtZero: true,
                 userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }
                 },
             }
            }]
        },
         plugins: {
              datalabels: { 
                display: true,
                color:'white',
                align:'center', 
                anchor:'center'    
            }}
      }
      });
    },

    error: function(data) {
      console.log(data);
    }

  });
});        
</script>

</body>
</html>

