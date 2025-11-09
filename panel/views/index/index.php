<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Rango de Edad', 'Clientes'],
        <?php foreach ($clientesPorEdad as $datos): ?>
          ['<?php echo $datos['rango']; ?>', <?php echo $datos['cantidad']; ?>],
        <?php endforeach; ?>
      ]);

      var options = {
        legend: { position: 'bottom' },
        chartArea: { 'width': '90%', 'height': '80%' }
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }

    window.onresize = drawChart;
  </script>
</head>

<body>
  <h1>Panel de Administración</h1>

  <div class="dashboard">

    <div class="dashboard-card card-stat">
      <h2>Total de Clientes Registrados</h2>
      <h3 class="stat-number">
        <?php echo (isset($totalClientes)) ? $totalClientes : 0; ?>
      </h3>
    </div>

    <div class="dashboard-card">
      <h2>Clientes por Rango de Edad</h2>
      <div id="piechart" class="chart-container"></div>
    </div>

  </div>

</body>

</html>