<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_transaksi = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];
$usaha=$db->ViewUsahaUser();
require('controller/transaksicontroller.php');

switch ($upload) {
	case "1": upload_data(); break;
}

switch($sql){
	case "insert" : sql_insert();
		break;
	case "update": sql_update(); 
		break;
	case "delete": sql_delete(); 
		break;	
	
}


switch($a){
	case "reset" : curd_read();
		break;
	case "tambah" : curd_create();
		break;
	case "edit"  :  curd_update($id_transaksi); 
		break;
	case "hapus"  :  curd_delete($id_transaksi); 
		break;
	case "tambahgambar"  :  curd_tambahgambar(); 
		break;
	default : curd_read();
		break;
}

$kdaba=null;

function curd_read(){
	 $hasil=sql_select();
	?>
	<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Transaksi</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=allt&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>
			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Transaksi</th>
                  <th>Jenis Transaksi</th>
                  <th>Jumlah</th>
                  <th>Nama Usaha</th>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Transaksi</th>
                  <th>Jenis Transaksi</th>
                  <th>Jumlah</th>
                  <th>Nama Usaha</th>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Menu</th>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['nm_transaksi']; ?></td>
                  <td><?php echo $baris['jenis_transaksi']; ?></</td>
                  <td><?php rupiah($baris['jumlah']); ?></</td>
                  <td><?php echo $baris['nm_usaha']; ?></</td>
                  <td><?php echo $baris['tanggal']; ?></</td>
                  <td><?php echo $baris['deskripsi']; ?></</td>
                  <td>
	                  <div class="btn-group-vertical">
						<a href="index.php?page=allt&a=edit&id=<?php echo $baris['id_transaksi'];?>" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
						<a href="index.php?page=allt&a=hapus&id=<?php echo $baris['id_transaksi'];?>" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
					</div>
					</td>
                </tr>
               <?php
           		}
               ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
	
<?php		
}
 

 function sql_select(){

 	$data=ViewDataTransaksi();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
	global $usaha
?>

		<label for="nm_transaksi">Nama Transaksi</label>			
		
			<input type="text" name="nm_transaksi" id="nm_transaksi" class="form-control" placeholder="Masukan Nama Transaksi yang dilakukan"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["nm_transaksi"]);} ?>" >

		<label for="jenis_transaksi">Jenis Transaksi</label>
		
			<select class="form-control" name="jenis_transaksi" id="jenis_transaksi" >
				<option value="" >-Pilih Jenis Transaksi-</option>
			    <option value="Pemasukan" <?php if($_GET['a']=="edit" and 'Pemasukan'==$row['jenis_transaksi']){echo " selected ";}?>>Pemasukan</option>
			    <option value="Pengeluaran" <?php if($_GET['a']=="edit" and 'Pengeluaran'==$row['jenis_transaksi']){echo " selected ";}?>>Pengeluaran</option>
				?>
			</select>

		<label for="jumlah">Jumlah Uang</label>			
		
			<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Rp. 0.0" maxlength="30" size="30"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["jumlah"]);} ?>" >

		<label for="id_usaha">Nama Usaha</label>			
		
			<select class="form-control" name="id_usaha" id="id_usaha" >
				<option value="" >-Pilih Nama Usaha-</option>
			    <?php 
			    foreach ($usaha as $regional) {
			    	if($datapetani !="kosong" and $regional['id_usaha']==$row['id_usaha']){
			    		$class="selected";
			    	}else{
			    		$class=' ';
			    	}
			    	echo '<option value="'.$regional['id_usaha'].'"  '.$class.'> '.$regional['nm_usaha'].'</option>';
				}
				?>
			</select>

		<label for="tanggal">Tanggal Transaksi Dilakukan</label>
			
			<input type="date" name="tanggal" id="tanggal" class="form-control" size="10"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["tanggal"]);} ?>" >

		<label for="deskripsi">Deksripsi Usaha</label>			
		
			<textarea name="deskripsi" id="deskripsi" class="form-control" maxlength="250" placeholder="Masukan deksripsi lengkap tentang Transaksi anda" value="<?php IF ($_GET['a']=="edit"){ echo trim($row["deksripsi"]);} ?>" ><?php IF ($_GET['a']=="edit"){ echo trim($row["deskripsi"]);} ?></textarea>
		

			<br/>
	

<?php  }?>


<?php 

function curd_create() 
{
	?>
		<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tambah Data Table Transaksi</div>
   		<div class="card-body">
		<h3>Masukan Transaksi Baru Anda!</h3><br>
		<a href="index.php?page=allt&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=allt&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_transaksi" => "",
		  "nm_transaksi" => "",
		  "jenis_transaksi" => "",
		  "jumlah" => "",
		  "tanggal" => "",
		  "id_usaha" => "-",
		  "deksripsi" => "-");
		formeditor($row);
	?>
		<p><input type="submit" name="submit" value="Simpan" class="btn btn-primary" ></p>
		</form>
		</div>
		</div>
	<?php 
}
function sql_insert()
	{
	  
	  InputDataTransaksi();
	}
	?>
<?php

function curd_update($id_transaksi) 
{
	$hasil2 = sql_select_byid($id_transaksi);
	foreach ($hasil2 as $row) {
		
	}
	
	?>
	<h3>Mengubahan Data Transaksi</h3><br>
	<a href="index.php?page=allt&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=allt&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_transaksi" value="<?php  echo $row['id_transaksi']; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_transaksi)
{
  global $db;
 	$data=ViewDataTransaksiOne($id_transaksi);
 	return $data;
}

function sql_update()
{
  UpdateDataTransaksi();
}
?>

<?php
function curd_delete($id_transaksi) 
{
global $kdb;
$hasil2 = sql_select_byid($id_transaksi);
foreach ($hasil2 as $row) {}
?>
<h3>Menghapus Data Transaksi</h3><br>
<a href="index.php?page=allt&a=reset" class="btn btn-warning">Batal</a>
<br>
<form action="index.php?page=allt&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_transaksi" value="<?php  echo $id_transaksi; ?>" >
<h3> Anda yakin akan menghapus data Transaksi ? <?php echo $row['nm_transaksi'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
 	DeleteDataTransaksi(); 
}