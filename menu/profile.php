<?php
$datapetani=$db->CariData('petani','id_user',$_SESSION['id_user']);
if($datapetani!="kosong"){
foreach ($datapetani as $data) {
	$regionalpetani=$db->CariData('regional','id_regional',$data['id_regional']);
}
}
if(!empty($regionalpetani)){
foreach ($regionalpetani as $regional) {
}
}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-4" align="center">
			<img src="upload/image/<?php echo $data['foto'];?>" class="img-circle" width="200px" height="200px">
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
						<b><?php if(!empty($data['nmpetani'])){echo $data['nmpetani'];} ?></b>
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
						<?php if(!empty($data['tgl_lahir'])){echo $data['tgl_lahir'];} ?>
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
						<?php if(!empty($data['tgl_lahir'])){echo $data['no_hp'];} ?>
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
						<?php if(!empty($data['tgl_lahir'])){echo $data['agama'];} ?>
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
						<?php if(!empty($data['tgl_lahir'])){echo $regional['nm_regional'];} ?>
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
						<?php if(!empty($data['tgl_lahir'])){echo $data['jenis_kelamin'];} ?>
					</td>
				</tr>
				<tr>
					<td>
						Id User
					</td>
					<td>
						:
					</td>
					<td>
						<?php if(!empty($data['tgl_lahir'])){echo $_SESSION['id_user'];} ?>
					</td>
				</tr>
			</table>
			<a href="index.php?page=profileedit" class="btn btn-primary"><i class="fa fa-fw fa-pencil-square-o"></i>Edit</a>
		</div>
	</div>
</div>