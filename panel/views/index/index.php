<h1 class="page-title">Dashboard</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card text-center text-white" style="background-color: var(--color-acento-verde);">
            <div class="card-header bg-transparent border-bottom-0">
                <h5 class="card-title mb-0">Total de Clientes</h5>
            </div>
            <div class="card-body">
                <h2 class="display-3 fw-bold"><?php echo (isset($totalClientes)) ? $totalClientes : 0; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Clientes por Rango de Edad
            </div>
            <div class="card-body">
                <div id="piechart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Google Charts Loader -->
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
        chartArea: { 'width': '90%', 'height': '80%' },
        colors: ['#2F4F4F', '#483D8B', '#556B2F', '#8B0000', '#36454F', '#008B8B']
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    window.addEventListener('resize', drawChart);
</script>

