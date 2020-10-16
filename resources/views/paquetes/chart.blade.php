<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chartisan example</title>
</head>

{{-- Info en
    https://chartisan.dev/documentation/examples#Different-datasets
    https://charts.erik.cat/guide/create_charts.html#create-the-chartisan-instance
--}}

<body>
    <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div>

    <!-- Chart's container -->
    <div id="chart2" style="height: 300px;"></div>

    <!-- Chart's container -->
    <div id="chart3" style="height: 300px;"></div>

    <!-- Charting library con echarts-->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

    <!-- Charting library con charts.js-->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
        el: '#chart',
        url: "@chart('my_chart')",
      });

      const chart2 = new Chartisan({
        el: '#chart2',
        url: "@chart('my_chart')",
        hooks: new ChartisanHooks()
    .colors(['#ECC94B', '#4299E1'])
    .responsive()
    .beginAtZero()
    .legend({ position: 'bottom' })
    .title('This is a sample chart using chartisan!')
    .datasets([{ type: 'line', fill: false }, 'bar']),
      });

      const chart3 = new Chartisan({
        el: '#chart3',
        url: "@chart('my_chart')",
        hooks: new ChartisanHooks()
    .datasets('doughnut')
    .pieColors(),

      });
    </script>
</body>

</html>
