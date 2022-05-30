<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_alat = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];

require('controller/alatcontroller.php');
$petani=ViewDataPetaniAlat();
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
	case "edit"  :  curd_update($id_alat); 
		break;
	case "hapus"  :  curd_delete($id_alat); 
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
          <i class="fa fa-table"></i> Data Table Alat</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=alat&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>
			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Alat</th>
                  <th>Harga</th>
                  <th>Nama Pemilik</th>
                  <th>Deskripsi</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Alat</th>
                  <th>Harga</th>
                  <th>Nama Pemilik</th>
                  <th>Deskripsi</th>
                  <th>Menu</th>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['nm_alat']; ?></td>
                  <td><?php rupiah($baris['harga']); ?></</td>
                  <td><?php echo $baris['nmpetani']; ?></</td>
                  <td><?php echo $baris['deskripsi']; ?></</td>
                  <td>
	                  <div class="btn-group-vertical">
						<a href="index.php?page=alat&a=edit&id=<?php echo $baris['id_alat'];?>" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
						<a href="index.php?page=alat&a=hapus&id=<?php echo $baris['id_alat'];?>" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
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

 	$data=ViewDataAlat();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
	global $petani
?>

		<label for="nm_alat">Nama Lahan</label>			
		
			<input type="text" name="nm_alat" id="nm_alat" class="form-control" placeholder="Masukan Nama Alat"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["nm_alat"]);} ?>" >

		<label for="harga">Harga</label>
		
			<input type="text" name="harga" id="harga" class="form-control" placeholder="Masukan Harga Alat Dalam Rupiah"  maxlength="30" size="30" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["harga"]);} ?>" >

		<label for="id_petani">Nama Petani</label>
		
			<select class="form-control" name="id_petani" id="id_petani" >
			    <?php 
			    foreach ($petani as $regional) {
			    	if($datapetani !="kosong" and $regional['id_petani']==$row['id_petani']){
			    		$class="selected";
			    	}else{
			    		$class=' ';
			    	}
			    	echo '<option value="'.$regional['idpetani'].'"  '.$class.'> '.$regional['nmpetani'].'</option>';
				}
				?>
			</select>

		<label for="deskripsi">Deksripsi Alat</label>			
		
			<textarea name="deskripsi" id="deskripsi" class="form-control" maxlength="250" placeholder="Masukan deksripsi lengkap tentang Alat anda" value="<?php IF ($_GET['a']=="edit"){ echo trim($row["deksripsi"]);} ?>" ><?php IF ($_GET['a']=="edit"){ echo trim($row["deskripsi"]);} ?></textarea>
		

			<br/>
	

<?php  }?>


<?php 

function curd_create() 
{
	?>
		<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tambah Data Table Alat</div>
   		<div class="card-body">
		<h3>Masukan Alat Baru Anda!</h3><br>
		<a href="index.php?page=alat&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=alat&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_alat" => "",
		  "nm_alat" => "",
		  "harga" => "",
		  "id_petani" => "",
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
	  
	  InputDataAlat();
	}
	?>
<?php

function curd_update($id_alat) 
{
	$hasil2 = sql_select_byid($id_alat);
	foreach ($hasil2 as $row) {
		
	}
	
	?>
	<h3>Mengubahan Data Alat</h3><br>
	<a href="index.php?page=alat&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=alat&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_alat" value="<?php  echo $row['id_alat']; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_alat)
{
  global $db;
 	$data=ViewDataAlatOne($id_alat);
 	return $data;
}

function sql_update()
{
  UpdateDataAlat();
}
?>

<?php
function curd_delete($id_alat) 
{
global $kdb;
$hasil2 = sql_select_byid($id_alat);
foreach ($hasil2 as $row) {}
?>
<h3>Menghapus Data Alat</h3><br>
<a href="index.php?page=alat&a=reset" class="btn btn-warning">Batal</a>
<br>
<form action="index.php?page=alat&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_alat" value="<?php  echo $id_alat; ?>" >
<h3> Anda yakin akan menghapus data Alat ? <?php echo $row['nm_alat'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
 	DeleteDataAlat(); 
}