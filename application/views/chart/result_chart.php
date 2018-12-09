<div class="col-md-10">
	<h3>GRAFIK PENJUALAN</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Data Penjualan
		</div>
		<div class="panel-body">
			<div id="donutchart" style="height: 500px;"></div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/loader2.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		<?php if ($jumlah > 0) { ?>
	 	google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
     	function drawChart() {
	        var data = google.visualization.arrayToDataTable(<?php echo $result; ?>);

	        var options = {
	          title: 'Grafik Penjualan',
	          pieHole : 0.3
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
	        chart.draw(data, options);
		}
		<?php } else { ?>
			var element = "<div class='alert alert-danger'>Tidak ada penjualan di Bulan ini</div>";
			var backButton = " <a href='<?php echo base_url('dashboard/graphic_sale'); ?>' class='btn-link'>Kembali</a>";
			$("#donutchart").append(element);
			$(".alert").append(backButton);
		<?php } ?>
  });
</script>