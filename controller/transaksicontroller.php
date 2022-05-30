<?php
	function ViewDataTransaksi(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if($_SESSION['level']=='admin'){
			$sql=" select * from transaksi as a,usaha as b where a.id_usaha=b.id_usaha";
		}
		else{

			$sql="select * from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user'];
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
	}	
	function InputDataTransaksi(){
		global $db;
		$dbb=$db->MysqlOpen();

		  $sql  = "INSERT INTO `db_fbm`.`transaksi` (`id_transaksi`, `nm_transaksi`, `jenis_transaksi`, `jumlah`, `id_usaha`, `tanggal`, `deskripsi`) VALUES (NULL, '".$_POST['nm_transaksi']."', '".$_POST['jenis_transaksi']."', '".$_POST['jumlah']."', ".$_POST['id_usaha'].", '".$_POST['tanggal']."', '".$_POST['deskripsi']."')";
		  
		  $dbb->query($sql); 
	}
	function ViewDataTransaksiOne($id_transaksi){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql = " select * from transaksi as a,usaha as b where a.id_usaha=b.id_usaha and a.id_transaksi = ".$id_transaksi; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	function UpdateDataTransaksi(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$petani=$kdaba->query("select * from petani where id_user=".$_SESSION['id_user']."");
		foreach ($petani as $idpetani) {}
		$sql  = "UPDATE `transaksi` SET `nm_transaksi`='".$_POST['nm_transaksi']."',`jenis_transaksi`='".$_POST['jenis_transaksi']."',`jumlah`=".$_POST['jumlah'].",`id_usaha`=".$_POST['id_usaha'].",`tanggal`='".$_POST['tanggal']."',`deskripsi`='".$_POST['deskripsi']."' WHERE `id_transaksi`=".$_POST['id_transaksi']."";			  
		  $kdaba->query( $sql); 
	}

	function DeleteDataTransaksi(){
		global $db;
		$kdaba=$db->MysqlOpen();
		$sql  = " delete from `transaksi` where id_transaksi= ".$_POST["id_transaksi"];			  
  		$kdaba ->query($sql); 
	}

?>