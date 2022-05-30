<?php
require('database.php');
$db=new db();
function ViewDataTransaksiPerUserUsaha(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_POST['level']))	{
		if($_POST['level']=='admin'){
			$sql=" select * from transaksi as a,usaha as b where a.id_usaha=b.id_usaha";
		}
		else{

			$sql="select * from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_POST['id_user']." and a.id_usaha=".$_POST['id_usaha'];
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}
//SELECT sum(jumlah) as jumlah FROM `transaksi` WHERE jenis_transaksi like '%pengeluaran%' and id_usaha=1
function ViewJumlahTransaksi($Jenis,$IdUsaha){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_POST['level']))	{
		if($_POST['level']=='admin'){
			$sql="SELECT sum(jumlah) as jumlahp FROM `transaksi` WHERE jenis_transaksi like '%".$Jenis."%' and id_usaha=".$IdUsaha;
		}
		else{

			$sql="SELECT sum(jumlah) as jumlahp FROM `transaksi` WHERE jenis_transaksi like '%".$Jenis."%' and id_usaha=".$IdUsaha;
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}
?>