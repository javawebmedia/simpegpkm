<?php 
use App\Models\Pegawai_model;
use App\Models\Diklat_model;
$tahun 		= date('Y');
$m_diklat 	= new Diklat_model();
$diklat 	= $m_diklat->rekap_pertahun($tahun);
$diklat2 	= $m_diklat->rekap_pertahun($tahun);
?>

<style type="text/css" media="screen">
#chartdivDiklat {
  width: 100%;
  height: 40vh;
  font-size: 12px;
}
</style>

<div id="chartdivDiklat"></div>


<script>
// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdivDiklat");


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
  { value: <?php echo $diklat['pegawai_tanpa_diklat'] ?>, category: "Belum Diklat (<?php echo $diklat['pegawai_tanpa_diklat'] ?>)" },
  { value: <?php echo $diklat['pegawai_jpl_kurang_40'] ?>, category: "Kurang dari 40 JPL (<?php echo $diklat['pegawai_jpl_kurang_40'] ?>)" },
  { value: <?php echo $diklat['pegawai_jpl_lebih_sama_40'] ?>, category: "Cukup 40 JPL (<?php echo $diklat['pegawai_jpl_lebih_sama_40'] ?>)" }
]);


// Create legend
// https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.percent(50),
  x: am5.percent(50),
  marginTop: 15,
  marginBottom: 15,
}));

let exporting2 = am5plugins_exporting.Exporting.new(root, {
  menu: am5plugins_exporting.ExportingMenu.new(root, {})
});

legend.data.setAll(series.dataItems);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);
</script>
<hr>
<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th>KETERANGAN</th>
			<th>JUMLAH</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Belum Diklat sama sekali</td>
			<td><?php echo $diklat2['pegawai_tanpa_diklat'] ?></td>
			<td>
				<a href="{{ asset('admin/diklat/listing/0') }}" class="btn btn-secondary btn-xs" target="_blank">
					<i class="fa fa-eye"></i> Lihat
				</a>
			</td>
		</tr>
		<tr>
			<td>Sudah Diklat tapi kurang dari 40 JP</td>
			<td><?php echo $diklat2['pegawai_jpl_kurang_40'] ?></td>
			<td>
				<a href="{{ asset('admin/diklat/listing/20') }}" class="btn btn-secondary btn-xs" target="_blank">
					<i class="fa fa-eye"></i> Lihat
				</a>
			</td>
		</tr>
		<tr>
			<td>Sudah Diklat Cukup untuk 40 JP</td>
			<td><?php echo $diklat2['pegawai_jpl_lebih_sama_40'] ?></td>
			<td>
				<a href="{{ asset('admin/diklat/listing/40') }}" class="btn btn-secondary btn-xs" target="_blank">
					<i class="fa fa-eye"></i> Lihat
				</a>
			</td>
		</tr>
	</tbody>
</table>
