<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_regional = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];
require('controller/regionalcontroller.php');

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
	case "edit"  :  curd_update($id_regional); 
		break;
	case "hapus"  :  curd_delete($id_regional); 
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
          <i class="fa fa-table"></i> Data Table regional</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=regional&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>
			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id Regional</th>
                  <th>Nama Regional</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id Regional</th>
                  <th>Nama Regional</th>
                  <th>Menu</th>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['id_regional']; ?></td>
                  <td><?php echo $baris['nm_regional']; ?></td>
                  <td>

                  	<?php if($_SESSION['level']=='admin'){
	                 echo '
	                  	<div class="btn-group-vertical">
							<a href="index.php?page=regional&a=edit&id='.$baris['id_regional'].'" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
							<a href="index.php?page=regional&a=hapus&id='.$baris['id_regional'].'" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
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

 	$data=ViewDataRegional();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
	global $usaha
?>


		<label for="nm_regional">Nama Regional</label>
		
			<input type="text" name="nm_regional" id="nm_regional" class="form-control" placeholder="Masukan Nama Regional anda"  maxlength="50" size="50" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["nm_regional"]);} ?>" >

		

		
		

			<br/>
	

<?php  }?>


<?php 

function curd_create() 
{
	?>
		<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tambah Data Table Regional</div>
   		<div class="card-body">
		<h3>Masukan Regional Baru Anda!</h3><br>
		<a href="index.php?page=regional&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=regional&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_regional" => "",
		  "nm_regional" => "");
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
	  
	  InputDataregional();
	}
	?>
<?php

function curd_update($id_regional) 
{
	$hasil2 = sql_select_byid($id_regional);
	foreach ($hasil2 as $row) {
		
	}
	
	?>
	<h3>Mengubahan Data Regional</h3><br>
	<a href="index.php?page=regional&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=regional&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_regional" value="<?php  echo $row['id_regional']; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_regional)
{
  global $db;
 	$data=ViewDataRegionalOne($id_regional);
 	return $data;
}

function sql_update()
{
  UpdateDataregional();
}
?>

<?php
function curd_delete($id_regional) 
{
global $kdb;
$hasil2 = sql_select_byid($id_regional);
foreach ($hasil2 as $row) {}
?>
<h3>Menghapus Data Regional</h3><br>
<a href="index.php?page=regional&a=reset" class="btn btn-warning">Batal</a>
<br>
<form action="index.php?page=regional&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_regional" value="<?php  echo $id_regional; ?>" >
<h3> Anda yakin akan menghapus data regional ? <?php echo $row['nm_regional'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
 	DeleteDataregional(); 
}
