
<?php
require('controller/dashboardcontroller.php');
$optahun=date('Y');
?>

<div class="container col-sm-10">
	<form action="index.php?" method="get" >
		<div class="input-group" >
			<span class="input-group-addon">Tampilkan Grafik Tahun |</span>
			<select name="tahun" id="tahun" class="form-control">
				<option value="<?php echo $optahun; ?>"><?php echo $optahun; ?></option>
				<?php	
				while($optahun>=2000){
					$optahun=$optahun-1;
					echo '<option value="'.$optahun.'">'.$optahun.'</option>';
				}
				?>
			</select>
			<input type="hidden" name="page" value="dashboard"/>
			<input type="submit" name="Tampilkan" value="Tampilkan" class="btn btn-primary"/>
		</div>
		<br/>
	</form>
	<h2 align="center">Grafik Pengeluaran dan Pemasukan Tahun <mark>
		<?php 
		if(!empty($_GET['tahun'])){
			echo $_GET['tahun'];
		}else{
			echo date('Y');
		}?>
		</mark>	
		</h2> 
	
	<canvas id="chartpengeluaran" width="400" height="200"></canvas>
</div>

<?php
$dpeng=ViewDataChartPengeluaran();
$dpeng1=ViewDataChartPengeluaran();
$dpem=ViewDataChartPemasukan();
$dpem1=ViewDataChartPemasukan();


?>
<script>

	var pengeluaranCanvas = document.getElementById("chartpengeluaran").getContext("2d");
	var barChart = new Chart(pengeluaranCanvas, {
	  type: 'bar',
	  data: {
	    labels: [<?php while ($b = $dpeng->fetch()) { echo '"' . tampil_bulan($b['bulan']) . '",';}?>],
	    datasets: [{
	      label: 'Pengeluaran',
	      data: [<?php while ($p = $dpeng1->fetch()) { echo '"' . $p['pengeluaran'] . '",';}?>],
	      backgroundColor: [
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)',
	        'rgba(255, 99, 132, 0.6)'
	      ],
	  }, {
	      label: 'Pemasukan',
	      data: [<?php while ($p = $dpem1->fetch()) { echo '"' . $p['pemasukan'] . '",';}?>],
	      backgroundColor: [
	        'rgba(119, 163, 119, 0.6)',
	        'rgba(43, 102, 43, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)',
	        'rgba(255, 99, 240, 0.6)'
	      ]
	    }]
	  }
	});
</script>
<div class="container col-sm-10">
	<table border="0" class="table table-hover">
	<tr>
		<th>Jumlah Pengeluaran Bulan Ini </th>
		<th>Jumlah Pemasukan Bulan ini </th>
	</tr>
	<tr>
		<?php
		$pemasukan=ViewDataPemasukanBulanini()->fetch();
		$pengeluaran=ViewDataPengeluaranBulanini()->fetch();
		?>
		<td><?php rupiah($pengeluaran['pengeluaran'])?></td>
		<td><?php rupiah($pemasukan['pemasukan'])?></td>
	</tr>
</table>
</div>
