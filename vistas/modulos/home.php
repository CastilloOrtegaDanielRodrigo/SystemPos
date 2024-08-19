<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido al Sistema</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .content-wrapper {
      text-align: center;
    }
    .chart-container {
      display: inline-block;
      width: 80%;
      max-width: 1400px;
      margin: 0 auto;
    }
    canvas {
      width: 100% !important;
      height: auto !important;
    }
  </style>
</head>
<body>
  <div class="content-wrapper">
    <section class="content-header" style="text-align: center;">
      <h1 style="font-size: 50px;">
        Bienvenido al Sistema
      </h1>
    </section>
    <section class="content">
      <div class="chart-container">
        <canvas id="myChart"></canvas>
      </div>
    </section>
  </div>

  <script>
    // Datos de ejemplo: ganancias mensuales
    const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const data = {
      labels: labels,
      datasets: [{
        label: 'Ganancias Mensuales',
        data: [2000, 3000, 2500, 4000, 3200, 2900, 3300, 3600, 4100, 3700, 3900, 4200],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    // Configuración del gráfico
    const config = {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // Renderizar el gráfico
    window.onload = function() {
      const ctx = document.getElementById('myChart').getContext('2d');
      new Chart(ctx, config);
    };
  </script>
</body>
</html>
