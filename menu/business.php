<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_usaha = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];
$lahan=$db->ReadData('lahan');
$petani=$db->ViewDataPetaniUsaha();

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
	case "edit"  :  curd_update($id_usaha); 
		break;
	case "hapus"  :  curd_delete($id_usaha); 
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
          <i class="fa fa-table"></i> Data Table Usaha</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=business&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>

			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Usaha</th>
                  <th>Jenis Usaha</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Lahan</th>
                  <?php if($_SESSION['level']=='admin'){echo'<th>Nama Petani</th>';}?>
                  <th>Descripsi</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Usaha</th>
                  <th>Jenis Usaha</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Lahan</th>
                  <?php if($_SESSION['level']=='admin'){echo'<th>Nama Petani</th>';}?>
                  <th>Descripsi</th>
                  <th>Menu</th>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['nm_usaha']; ?></td>
                  <td><?php echo $baris['jenis_usaha']; ?></</td>
                  <td><?php echo $baris['tgl_mulai']; ?></</td>
                  <td><?php echo $baris['tgl_selesai']; ?></</td>
                  <td><?php echo $baris['nm_lahan']; ?></</td>
                  <?php if($_SESSION['level']=='admin'){echo'<td>'.$baris['nmpetani'].'</td>';}?>
                  <td><?php echo $baris['deksripsi']; ?></</td>
                  <td>
	                  <div class="btn-group-vertical">
						<a href="index.php?page=business&a=edit&id=<?php echo $baris['id_usaha'];?>" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
						<a href="index.php?page=business&a=hapus&id=<?php echo $baris['id_usaha'];?>" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
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
 	global $db;
 	$data=$db->ViewDataUsaha();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
  	global $lahan;
  	global $petani;
?>

		<label for="nm_usaha">Nama Usaha</label>			
		
			<input type="text" name="nm_usaha" id="nm_usaha" class="form-control"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["nm_usaha"]);} ?>" >

		<label for="jenis_usaha">Jenis Usaha</label>			
		
			<input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" maxlength="30" size="30"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["jenis_usaha"]);} ?>" >

		<label for="tgl_mulai">Tanggal Mulai</label>			
		
			<input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" size="10"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["tgl_mulai"]);} ?>" >

		<label for="tgl_selesai">Tanggal Selesai</label>
			
			<input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" size="10"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["tgl_selesai"]);} ?>" >

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

			<label for="deksripsi">Deksripsi Usaha</label>
			
		
			<textarea name="deksripsi" id="deksripsi" class="form-control" maxlength="250"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["deksripsi"]);} ?>" ><?php IF ($_GET['a']=="edit"){ echo trim($row["deksripsi"]);} ?></textarea>
		
			<label for="id_lahan">Nama Lahan</label>
		
			<select class="form-control" name="id_lahan" id="id_lahan" >
			    <?php 
			    foreach ($lahan as $regional) {
			    	if($datapetani !="kosong" and $regional['id_lahan']==$row['id_lahan']){
			    		$class="selected";
			    	}else{
			    		$class=' ';
			    	}
			    	echo '<option value="'.$regional['id_lahan'].'"  '.$class.'> '.$regional['nm_lahan'].' | '.$regional['alamat'].' - '.$regional['luas'].' Meter Persegi</option>';
				}
				?>
			</select>
			<br/>
	

<?php  }?>


<?php 

function curd_create() 
{
	?>
		<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tambah Data Table Usaha</div>
   		<div class="card-body">
		<h3>Masukan Usaha Baru Anda!</h3><br>
		<a href="index.php?page=business&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=business&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_usaha" => "",
		  "nm_usaha" => "",
		  "jenis_usaha" => "",
		  "tgl_mulai" => "",
		  "tgl_selesai" => "",
		  "id_lahan" => "-",
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
	  global $db;
	  $db->InputDataUsaha();
	}
	?>
<?php

function curd_update($id_usaha) 
{
	global $kdaba;
	$hasil2 = sql_select_byid($id_usaha);
	foreach ($hasil2 as $row) {}
	
	?>
	<h3>Pengubahan Data MAhasiswa</h3><br>
	<a href="index.php?page=business&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=business&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_usaha" value="<?php  echo $id_usaha; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_usaha)
{
  global $db;
 	$data=$db->ViewDataUsahaOne($id_usaha);
 	return $data;
}

function sql_update()
{
  global $db;
  $db->UpdateDataUsaha();
}
?>

<?php
function curd_delete($id_usaha) 
{
global $kdb;
$hasil2 = sql_select_byid($id_usaha);
foreach ($hasil2 as $row) {}
?>
<h3>Penghapusan Data MAhasiswa</h3><br>
<a href="index.php?page=business&a=reset">Batal</a>
<br>
<form action="index.php?page=business&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_usaha" value="<?php  echo $id_usaha; ?>" >
<h3> Anda yakin akan menghapus data Usaha ? <?php echo $row['nm_usaha'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
  global $db;
  $db->DeleteDataUsaha(); 
  
}