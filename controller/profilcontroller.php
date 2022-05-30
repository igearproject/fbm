<?php

  

if(!empty($_POST['tprofil'])){
	$file_name = $_FILES["foto"]["name"];
	if($_POST['tprofil']=='Add'){
		
		$hasil=$db->InputDataPetani($_POST['nmpetani'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['id_regional'], $_POST['iduser'], $file_name);
	}
	if($_POST['tprofil']=='Save'){
		
		if(empty($file_name)){
			$file=$_POST['foto1'];
		}else{
			$file=$file_name;
		}
		$hasil=$db->EditDataPetani($_POST['nmpetani'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['id_regional'], $_POST['idpetani'], $_POST['iduser'], $file);
	}
}
?>