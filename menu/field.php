<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_lahan = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];
$usaha=$db->ViewUsahaUser();
require('controller/lahancontroller.php');

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
	case "edit"  :  curd_update($id_lahan); 
		break;
	case "hapus"  :  curd_delete($id_lahan); 
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
          <i class="fa fa-table"></i> Data Table Lahan</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=field&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>
			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Lahan</th>
                  <th>Alamat</th>
                  <th>Luas</th>
                  <th>Jenis Lahan</th>
                  <th>Fasilitas</th>
                  <th>Deskripsi</th>
                  <?php if($_SESSION['level']=='admin'){
	                 echo '
                  <th>Menu</th>';}?>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Lahan</th>
                  <th>Alamat</th>
                  <th>Luas</th>
                  <th>Jenis Lahan</th>
                  <th>Fasilitas</th>
                  <th>Deskripsi</th>
                  <?php if($_SESSION['level']=='admin'){
	                 echo '
                  <th>Menu</th>';}?>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['nm_lahan']; ?></td>
                  <td><?php echo $baris['alamat']; ?></</td>
                  <td><?php hektare($baris['luas']); ?></</td>
                  <td><?php echo $baris['jenis_lahan']; ?></</td>
                  <td><?php echo $baris['fasilitas']; ?></</td>
                  <td><?php echo $baris['deskripsi']; ?></</td>
                  <td>

                  	<?php if($_SESSION['level']=='admin'){
	                 echo '
	                  	<div class="btn-group-vertical">
							<a href="index.php?page=field&a=edit&id='.$baris['id_lahan'].'" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
							<a href="index.php?page=field&a=hapus&id='.$baris['id_lahan'].'" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
						</div>';
					}
					?>
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

 	$data=ViewDataLahan();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
	global $usaha
?>

		<label for="nm_lahan">Nama Lahan</label>			
		
			<input type="text" name="nm_lahan" id="nm_lahan" class="form-control" placeholder="Masukan Nama Lahan"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["nm_lahan"]);} ?>" >

		<label for="alamat">Alamat</label>
		
			<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat Lengkap Lahan"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["alamat"]);} ?>" >

		<label for="luas">Luas</label>			
		
			<input type="text" name="luas" id="luas" class="form-control" placeholder="Luas Lahan dalam meter persegi" maxlength="30" size="30"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["luas"]);} ?>" >

		<label for="jenis_lahan">Jenis Lahan</label>			
		
			<input type="text" name="jenis_lahan" id="jenis_lahan" class="form-control" placeholder="Masukan Jenis Lahan" maxlength="35" size="35"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["jenis_lahan"]);} ?>" >

		<label for="fasilitas">Fasilitas</label>
			
			<input type="text" name="fasilitas" id="fasilitas" class="form-control" maxlength="25" size="25"  placeholder="Masukan Fasilitas Lahan" value="<?php IF ($_GET['a']=="edit"){ echo trim($row["fasilitas"]);} ?>" >

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
          <i class="fa fa-table"></i> Tambah Data Table Lahan</div>
   		<div class="card-body">
		<h3>Masukan Lahan Baru Anda!</h3><br>
		<a href="index.php?page=field&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=field&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_lahan" => "",
		  "nm_lahan" => "",
		  "jenis_lahan" => "",
		  "luas" => "",
		  "fasilitas" => "",
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
	  
	  InputDataLahan();
	}
	?>
<?php

function curd_update($id_lahan) 
{
	$hasil2 = sql_select_byid($id_lahan);
	foreach ($hasil2 as $row) {
		
	}
	
	?>
	<h3>Mengubahan Data Lahan</h3><br>
	<a href="index.php?page=field&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=field&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_lahan" value="<?php  echo $row['id_lahan']; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_lahan)
{
  global $db;
 	$data=ViewDataLahanOne($id_lahan);
 	return $data;
}

function sql_update()
{
  UpdateDataLahan();
}
?>

<?php
function curd_delete($id_lahan) 
{
global $kdb;
$hasil2 = sql_select_byid($id_lahan);
foreach ($hasil2 as $row) {}
?>
<h3>Menghapus Data Lahan</h3><br>
<a href="index.php?page=field&a=reset" class="btn btn-warning">Batal</a>
<br>
<form action="index.php?page=field&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_lahan" value="<?php  echo $id_lahan; ?>" >
<h3> Anda yakin akan menghapus data Lahan ? <?php echo $row['nm_lahan'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
 	DeleteDataLahan(); 
}
