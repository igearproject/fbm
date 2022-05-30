<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$id_user = !empty($_GET['id']) ? $_GET['id'] : " ";
$a=@$_GET['a'];
$sql=@$_POST['sql'];
$upload = @$_POST["upload"];
$usaha=$db->ViewUsahaUser();
require('controller/usercontroller.php');

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
	case "edit"  :  curd_update($id_user); 
		break;
	case "hapus"  :  curd_delete($id_user); 
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
          <i class="fa fa-table"></i> Data Table User</div>
        <div class="card-body">
        	<div class="btn-group">
        		<a href='index.php?page=userfbm&a=tambah' class="btn btn-primary btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Data</a>
				<a href='index.php?page=export' class="btn btn-warning btn-xs"><i class="fa fa-fw  fa-file-text-o"></i>Export Data</a>
			</div>
			<br/>
			<br/>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID User</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level User</th>
                  <th>Status</th>
                  <th>Email</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID User</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level User</th>
                  <th>Status</th>
                  <th>Email</th>
                  <th>Menu</th>
                </tr>
              </tfoot>
              <tbody>
              	<?php
              	while($baris=$hasil->fetch()){
              	?>
                <tr>
                  <td><?php echo $baris['id_user']; ?></td>
                  <td><?php echo $baris['username']; ?></td>
                  <td><?php echo $baris['password']; ?></td>
                  <td><?php echo $baris['level_user']; ?></</td>
                  <td><?php echo $baris['status']; ?></</td>
                  <td><?php echo $baris['email']; ?></</td>
                  <td>

                  	<?php if($_SESSION['level']=='admin'){
	                 echo '
	                  	<div class="btn-group-vertical">
							<a href="index.php?page=userfbm&a=edit&id='.$baris['id_user'].'" class="btn btn-primary btn-xs"><i class="fa fa-fw fa-pencil-square-o"></i>UPDATE</a> 
							<a href="index.php?page=userfbm&a=hapus&id='.$baris['id_user'].'" class="btn btn-danger btn-xs "><i class="fa fa-fw fa-trash-o"></i>DELETE</a>
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

 	$data=ViewDataUser();
 	return $data;
 }
 ?>
 
 <?php 
function formeditor($row)
  {
	global $usaha
?>

		<label for="username">Username</label>			
		
			<input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username yang akan anda digunakan"  maxlength="30" size="30" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["username"]);} ?>" >

		<label for="password">Password</label>
		
			<input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password anda"  maxlength="200" size="200" value="<?php IF ($_GET['a']=="edit"){  echo trim($row["password"]);} ?>" >

		<label for="level_user">Level User</label>			
		
			<select name="level_user" id="level_user" class="form-control">
				<option value="user">-Pilih Level User-</option>
				<option value="user" <?php IF ($_GET['a']=="edit" and $row["level_user"]=="user"){ echo "selected";} ?>>User</option>
				<option value="admin" <?php IF ($_GET['a']=="edit" and $row["level_user"]=="admin"){ echo "selected";} ?>>Admin</option>
			</select> 

		<label for="status">Status User</label>			
		
			<select name="status" id="status" class="form-control">
				<option value="aktif">-Pilih Status User-</option>
				<option value="aktif" <?php IF ($_GET['a']=="edit" and $row["status"]=="aktif"){ echo "selected";} ?>>Aktif</option>
				<option value="non aktif" <?php IF ($_GET['a']=="edit" and $row["status"]=="non aktif"){ echo " selected";} ?>>Nonaktif</option>
			</select> 


		<label for="email">Email User</label>			
		
			<input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email Anda anda@Example.com" maxlength="100" size="100"  value="<?php IF ($_GET['a']=="edit"){ echo trim($row["email"]);} ?>" >

		
		

			<br/>
	

<?php  }?>


<?php 

function curd_create() 
{
	?>
		<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tambah Data Table User</div>
   		<div class="card-body">
		<h3>Masukan User Baru Anda!</h3><br>
		<a href="index.php?page=userfbm&a=reset" class ="btn btn-danger">Batal</a>
		<br>
		<form enctype="multipart/form-data" action="index.php?page=userfbm&a=reset" method="post">
		<!--<input type="hidden" name="upload" value="1">-->
		<input type="hidden" name="sql" value="insert" >
	<?php
		$row = array(
		  "id_user" => "",
		  "nm_User" => "",
		  "jenis_User" => "",
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
	  
	  InputDataUser();
	}
	?>
<?php

function curd_update($id_user) 
{
	$hasil2 = sql_select_byid($id_user);
	foreach ($hasil2 as $row) {
		
	}
	
	?>
	<h3>Mengubahan Data User</h3><br>
	<a href="index.php?page=userfbm&a=reset" class ="btn btn-danger">Batal</a>
	<br>
	<form action="index.php?page=userfbm&a=reset" method="post">
	<input type="hidden" name="sql" value="update" >
	<input type="hidden" name="id_user" value="<?php  echo $row['id_user']; ?>" >
	<?php
	formeditor($row)
	?>
	<p><input type="submit" class="btn btn-primary" name="action" value="Update" class="btn btn-primary"></p>
	</form>
<?php 
}
function sql_select_byid($id_user)
{
  global $db;
 	$data=ViewDataUserOne($id_user);
 	return $data;
}

function sql_update()
{
  UpdateDataUser();
}
?>

<?php
function curd_delete($id_user) 
{
global $kdb;
$hasil2 = sql_select_byid($id_user);
foreach ($hasil2 as $row) {}
?>
<h3>Menghapus Data User</h3><br>
<a href="index.php?page=userfbm&a=reset" class="btn btn-warning">Batal</a>
<br>
<form action="index.php?page=userfbm&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="id_user" value="<?php  echo $id_user; ?>" >
<h3> Anda yakin akan menghapus data User ? <?php echo $row['username'];?> </h3>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"></p>
</form>
<?php }

function sql_delete()
{
 	DeleteDataUser(); 
}
