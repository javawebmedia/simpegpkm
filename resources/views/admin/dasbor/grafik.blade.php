<?php 
use App\Models\Dasbor_model;
$m_dasbor       = new Dasbor_model();
// ambil data statistik
$grafik         = $m_dasbor->jenis_pegawai();
?>
<style type="text/css" media="screen">
#chartdiv {
  width: 100%;
  height: 80vh;
}
</style>

<div id="chartdiv"></div>
<script src="{{ asset('assets/amcharts5') }}/index.js"></script>
<script src="{{ asset('assets/amcharts5') }}/percent.js"></script>
<script src="{{ asset('assets/amcharts5') }}/themes/Animated.js"></script>

<script>
// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));


// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([
<?php foreach($grafik as $grafik) { ?>
  { value: <?php echo $grafik->total ?>, category: "<?php echo $grafik->jenis_pegawai ?>" },
<?php } ?>
]);


// Create legend
// https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.percent(50),
  x: am5.percent(50),
  marginTop: 15,
  marginBottom: 15,
}));

legend.data.setAll(series.dataItems);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);
</script>
