<?php
require_once("lib/db_parms.php");
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
$timestamp = array(); // tableau de timestamp
$power = array(); // tableau de power
try{
    $data = new DataLayer();
    $content = $data->getContent();
    $i = 0;
    foreach ($content as $key) {
        $timestamp[$i] = $key['timestamp'];
        $power[$i] = $key['power'];
        $i++;
    }

} catch (PDOException $e){
    $errorMessage = $e->getMessage();
}
$Label_timestamp = json_encode($timestamp);
$Data_power = json_encode($power, JSON_NUMERIC_CHECK);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>graphiqueWithChartJs</title>
    </head>
    <body>
      <div style="width: 75%">
          <canvas id="myChart"></canvas>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
      <script type="text/javascript">
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: <?php echo $Label_timestamp; ?>,
                datasets: [{
                    label: 'données',
                    data: <?php echo $Data_power; ?>,
                    backgroundColor: 'rgb(0, 128, 64)',

                  }]
                },
          options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
          }
        });
      </script>

    </body>
</html>
