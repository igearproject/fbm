<?php
	function hektare($nilai){
        echo $hasil=number_format($nilai,0,',','.')." m<sup>2</sup>";
    } 
	function ViewDataLahan(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from lahan";
		}
		else{

			$sql=" select * from lahan";
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}	
function InputDataLahan(){
		global $db;
		$dbb=$db->MysqlOpen();

		  $sql  = "INSERT INTO `lahan`(`id_lahan`, `nm_lahan`, `alamat`, `luas`, `jenis_lahan`, `fasilitas`, `deskripsi`) VALUES (null, '".$_POST['nm_lahan']."','".$_POST['alamat']."',".$_POST['luas'].",'".$_POST['jenis_lahan']."','".$_POST['fasilitas']."','".$_POST['deskripsi']."')";
		  
		  $perintah=$dbb->query($sql); 
		  if($perintah){
		  	$db->Peringatan('Input Data Lahan Berhasil','success');
		  }else{
		  	$db->Peringatan('Input Data Lahan Gagal','danger');
		  }
	}
function ViewDataLahanOne($id_lahan){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql = " select * from lahan where id_lahan = ".$id_lahan; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	function UpdateDataLahan(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$petani=$kdaba->query("select * from petani where id_user=".$_SESSION['id_user']."");
		foreach ($petani as $idpetani) {}
		$sql  = "UPDATE `lahan` SET `nm_lahan`='".$_POST['nm_lahan']."',`alamat`='".$_POST['alamat']."',`luas`=".$_POST['luas'].", `jenis_lahan`='".$_POST['jenis_lahan']."',`fasilitas`='".$_POST['fasilitas']."',`deskripsi`='".$_POST['deskripsi']."' WHERE `id_lahan`=".$_POST['id_lahan']."";			  
		 $perintah=$kdaba->query( $sql); 
		  if($perintah){
		  	$db->Peringatan('Update Data Lahan Berhasil','success');
		  }else{
		  	$db->Peringatan('Update Data Lahan Gagal','danger');
		  }
	}

	function DeleteDataLahan(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = " delete from `lahan` where id_lahan= ".$_POST["id_lahan"];	
		try{
			$perintah=$kdaba ->query($sql); 
			if($perintah){
			  	$db->Peringatan('Delete Data Lahan Berhasil','success');
			}else{
			  	$db->Peringatan('Delete Data Lahan Gagal','danger');
			}
		}		  
  		catch(PDOException $e){
  			$db->Peringatan('Data Lahan Tidak Dapat Dihapus','danger');
  		}
		
	}

?>