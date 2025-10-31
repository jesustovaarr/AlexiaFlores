<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Rango de Edad', 'Clientes'],
          <?php foreach($datosGraficas as $datos): ?>
          ['<?php echo $datos['rango']; ?>', <?php echo $datos['cantidad']; ?>],
          <?php endforeach; ?>
        ]);

        var options = {
          title: 'Clientes por Rango de Edad'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <h1>Bienvenido al sistema</h1>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>