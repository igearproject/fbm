<?php

	function ViewDataUser(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from user";
		}
		
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}	
function InputDataUser(){
		global $db;
		$dbb=$db->MysqlOpen();
		if($_SESSION['level']=='admin'){
			$sql  = "INSERT INTO `user`(`id_user`, `username`, `password`, `level_user`, `status`, `email`) VALUES (null,'".$_POST['username']."','".$_POST['password']."','".$_POST['level_user']."','".$_POST['status']."','".$_POST['email']."')";
		  
		  $perintah=$dbb->query($sql); 
		  if($perintah){
		  	$db->Peringatan('Input Data user Berhasil','success');
		  }else{
		  	$db->Peringatan('Input Data user Gagal','danger');
		  }
		}
		  
	}
function ViewDatauserOne($id_user){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql = " select * from user where id_user = ".$id_user; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	function UpdateDataUser(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = "UPDATE `user` SET `username`='".$_POST['username']."',`password`='".$_POST['password']."',`level_user`='".$_POST['level_user']."',`status`='".$_POST['status']."',`email`='".$_POST['email']."' WHERE `id_user`=".$_POST['id_user']."";			  
		 $perintah=$kdaba->query( $sql); 
		  if($perintah){
		  	$db->Peringatan('Update Data user Berhasil','success');
		  }else{
		  	$db->Peringatan('Update Data user Gagal','danger');
		  }
	}

	function DeleteDataUser(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = " delete from `user` where id_user= ".$_POST["id_user"];			  
  		$perintah=$kdaba ->query($sql); 
		if($perintah){
		  	$db->Peringatan('Delete Data user Berhasil','success');
		  }else{
		  	$db->Peringatan('Delete Data user Gagal','danger');
		  }
	}

?>