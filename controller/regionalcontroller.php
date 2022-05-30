<?php

	function ViewDataRegional(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from regional";
		}
		
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}	
function InputDataRegional(){
		global $db;
		$dbb=$db->MysqlOpen();
		if($_SESSION['level']=='admin'){
			$sql  = "INSERT INTO `regional`(`id_regional`, `nm_regional`) VALUES (null,'".$_POST['nm_regional']."')";
		  
		  $perintah=$dbb->query($sql); 
		  if($perintah){
		  	$db->Peringatan('Input Data Regional Berhasil','success');
		  }else{
		  	$db->Peringatan('Input Data Regional Gagal','danger');
		  }
		}
		  
	}
function ViewDataRegionalOne($id_Regional){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql = " select * from regional where id_regional = ".$id_Regional; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	function UpdateDataRegional(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = "UPDATE `regional` SET `nm_regional`='".$_POST['nm_regional']."' WHERE `id_regional`=".$_POST['id_regional']."";			  
		 $perintah=$kdaba->query( $sql); 
		  if($perintah){
		  	$db->Peringatan('Update Data Regional Berhasil','success');
		  }else{
		  	$db->Peringatan('Update Data Regional Gagal','danger');
		  }
	}

	function DeleteDataRegional(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = " delete from `regional` where id_regional= ".$_POST["id_regional"];			  
  		$perintah=$kdaba ->query($sql); 
		if($perintah){
		  	$db->Peringatan('Delete Data Regional Berhasil','success');
		  }else{
		  	$db->Peringatan('Delete Data Regional Gagal','danger');
		  }
	}

?>