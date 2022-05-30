<?php
 
function ViewDataAlat(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from alat as a, petani as b where a.id_petani=b.idpetani";
		}
		else{

			$sql=" select * from alat as a, petani as b where a.id_petani=b.idpetani and b.id_user=".$_SESSION['id_user'];
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}	

function ViewDataPetaniAlat(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from petani";
		}
		else{

			$sql=" select * from petani as b where b.id_user=".$_SESSION['id_user'];
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}
function InputDataAlat(){
		global $db;
		$dbb=$db->MysqlOpen();

		  $sql  = "INSERT INTO `alat`(`id_alat`, `nm_alat`, `harga`, `id_petani`, `deskripsi`) VALUES (null,'".$_POST['nm_alat']."','".$_POST['harga']."',".$_POST['id_petani'].",'".$_POST['deskripsi']."')";
		  
		  $perintah=$dbb->query($sql); 
		  if($perintah){
		  	$db->Peringatan('Input Data Alat Berhasil','success');
		  }else{
		  	$db->Peringatan('Input Data Alat Gagal','danger');
		  }
	}

function ViewDataAlatOne($id_Alat){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql = " select * from alat where id_Alat = ".$id_Alat; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	function UpdateDataAlat(){
		global $db;
		$kdaba=$db->MysqlOpen();

		$sql  = "UPDATE `alat` SET `nm_alat`='".$_POST['nm_alat']."',`harga`=".$_POST['harga'].",`id_petani`='".$_POST['id_petani']."',`deskripsi`='".$_POST['deskripsi']."' WHERE `id_alat`=".$_POST['id_alat']."";			  
		 $perintah=$kdaba->query( $sql); 
		  if($perintah){
		  	$db->Peringatan('Update Data Alat Berhasil','success');
		  }else{
		  	$db->Peringatan('Update Data Alat Gagal','danger');
		  }
	}


	function DeleteDataAlat(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = " delete from `alat` where id_alat= ".$_POST["id_alat"];			  
  		
		try{
			$perintah=$kdaba ->query($sql); 
			if($perintah){
			  	$db->Peringatan('Delete Data Alat Berhasil','success');
			}else{
		  		$db->Peringatan('Delete Data Alat Gagal','danger');
		  	}
		}		  
  		catch(PDOException $e){
  			$db->Peringatan('Data Alat Tidak Dapat Dihapus','danger');
  		}
	}

?>