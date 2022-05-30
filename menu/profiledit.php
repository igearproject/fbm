<?php
include('controller/profilcontroller.php');

if(!empty($_SESSION['id_user']) and $_SESSION['level']='user'){
	$iduser=$_SESSION['id_user'];
}else{
	$iduser=$_GET['id_user'];
}

$datapetani=$db->CariData('petani','id_user',$iduser);
if($datapetani!="kosong"){
foreach ($datapetani as $data) {
	
}
}
$regionalpetani=$db->ReadData('regional');

?>

<div class="container">
	
	<form action="index.php?page=profileedit" enctype="multipart/form-data" method="post">
	<div class="row">
		<div class="col-sm-4" align="center">
			<img src="upload/image/<?php echo $data['foto'];?>" class="img-circle" align="center" width="200px" height="200px">
			<br/><br/>
			<input type="file" name="foto" id="foto" class="form-control" >
			<input type="hidden" name="foto1" id="foto1" value="<?php echo $data['foto'] ?>">

			
		</div>
		
		<div class="col-sm-8">
			<table class="table table-hover">
				<tr>
					<td>
						Nama
					</td>
					<td>
						:
					</td>
					<td>
						<input type="text" class="form-control" maxlength="50" name="nmpetani" value="<?php if(!empty($data)){echo $data['nmpetani'];} ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						Tanggal Lahir
					</td>
					<td>
						:
					</td>
					<td>
						<input type="date" class="form-control" name="tgl_lahir" value="<?php if(!empty($data)){echo $data['tgl_lahir'];} ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						Nomor HP
					</td>
					<td>
						:
					</td>
					<td>
						<input type="text" class="form-control" maxlength="15" name="no_hp" value="<?php if(!empty($data)){echo $data['no_hp'];} ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						Agama
					</td>
					<td>
						:
					</td>
					<td>
						<input type="text" class="form-control" maxlength="10" name="agama" value="<?php if(!empty($data)){echo $data['agama'];} ?>"/>
					</td>
				</tr>
				<tr>
					<td>
						Regional
					</td>
					<td>
						:
					</td>
					<td>
						<select class="form-control" name="id_regional" id="id_regional" >
						    <?php 
						    foreach ($regionalpetani as $regional) {
						    	if($datapetani !="kosong" and $regional['id_regional']==$data['id_regional']){
						    		$class="selected";
						    	}else{
						    		$class=' ';
						    	}
						    	echo '<option value="'.$regional['id_regional'].'"  '.$class.'> '.$regional['nm_regional'].'</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Jenis Kelamin
					</td>
					<td>
						:
					</td>
					<td>
						<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
							<option value="P" <?php if($datapetani !="kosong" and $data['jenis_kelamin']=='P'  ){echo 'selected';}?>>Female</option>
							<option value="L" <?php if($datapetani !="kosong" and $data['jenis_kelamin']=='L'){echo 'selected';}?>>Male</option>
						</select>
					</td>
				</tr>
			</table>
			<input type="hidden" name="idpetani" value="<?php echo $data['idpetani'];?>">
			<input type="hidden" name="iduser" value="<?php echo $_SESSION['id_user'];?>">
			<input type="hidden" name="upload" value="1" >
			<div class="btn-group">
			<a href="index.php?page=profile" class="btn btn-danger">Cancel</a>
			<?php if($datapetani =="kosong"){echo '<input type="submit" name="tprofil" class="btn btn-primary" value="Add" />';}?>
			<?php if($datapetani !="kosong"){echo '<input type="submit" name="tprofil" class="btn btn-primary" value="Save" />';}?>
			</div>
<br/><br/>
			
		</div>
		</form>
		<?php
			if(isset($_POST['tprofil']) and isset($_FILES['foto'])){
				$up->foto();
			}

		?>
		
	</div>
</div>