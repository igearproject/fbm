<?php
$usaha=$db->ViewUsahaUser();
?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Export Data Usaha
    </div>
   	<div class="card-body">
   		<form method="post" action="export_data_transaksi.php">
   			<label for="id_usaha">Pilih Usaha</label>
   			<select name="id_usaha" class="form-control">
   				<option value="">-Pilih Nama Usaha-</option>
   				<?php
   				foreach ($usaha as $row) {
   					echo'<option value="'.$row['id_usaha'].'">'.$row['nm_usaha'].'</option>';
   				}
   				?>
   			</select>
   			<br/>
   			<input type="hidden" name="level" value="<?php echo $_SESSION['level'] ?>">
   			<input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>">
   			<input type="submit" class="btn btn-primary" name="export" value="export">
   		</form>
   		</div>
</div>