<?php
 
function ViewDataChartPengeluaran(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if(!empty($_GET['tahun'])){
			$tahun=$_GET['tahun'];
		}
		else{
			$tahun=date('Y');
		}
		if($_SESSION['level']=='admin'){
			$sql="select sum(jumlah) as pengeluaran,month(tanggal) as bulan from transaksi where tanggal like '%".$tahun."%' and jenis_transaksi='Pengeluaran' group by month(tanggal);";
		}
		else{

			$sql="select sum(a.jumlah) as pengeluaran,month(a.tanggal) as bulan from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user']." and a.tanggal like '%".$tahun."%' and a.jenis_transaksi='Pengeluaran' group by month(a.tanggal);";
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}	
function ViewDataChartPemasukan(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
		if(!empty($_GET['tahun'])){
			$tahun=$_GET['tahun'];
		}
		else{
			$tahun=date('Y');
		}
		if($_SESSION['level']=='admin'){
			$sql="select sum(jumlah) as pemasukan,month(tanggal) as bulan from transaksi where tanggal like '%".$tahun."%' and jenis_transaksi='Pemasukan' group by month(tanggal);";
		}
		else{

			$sql="select sum(a.jumlah) as pemasukan,month(a.tanggal) as bulan from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user']." and a.tanggal like '%".$tahun."%' and a.jenis_transaksi='Pemasukan' group by month(a.tanggal);";
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}	
function tampil_bulan ($x) {
    switch ($x) {
        case 1  : $bulan = "Januari";
           break;
        case 2  : $bulan = "Februari";
           break;
        case 3  : $bulan = "Maret";
           break;
        case 4  : $bulan = "April";
           break;
        case 5  : $bulan = "Mei";
           break;
        case 6  : $bulan = "Juni";
           break;
        case 7  : $bulan = "Juli";
           break;
        case 8  : $bulan = "Agustus";
           break;
        case 9  : $bulan = "September";
           break;
        case 10 : $bulan = "Oktober";
           break;
        case 11 : $bulan = "November";
           break;
        case 12 : $bulan = "Desember";
           break;
    }
    return $bulan;
}

function ViewDataPemasukanBulanini(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
			$tahun=date('Y');
			$bulan=date('m');
		
		if($_SESSION['level']=='admin'){
			$sql="select sum(jumlah) as pemasukan,month(tanggal) as bulan from transaksi where tanggal like '%".$tahun."%' and month(tanggal)='".$bulan."' and jenis_transaksi='Pemasukan'";
		}
		else{

			$sql="select sum(a.jumlah) as pemasukan,month(a.tanggal) as bulan from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user']." and a.tanggal like '%".$tahun."%' and month(a.tanggal)= '".$bulan."' and a.jenis_transaksi='Pemasukan' group by month(a.tanggal);";
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}
function ViewDataPengeluaranBulanini(){
	global $db;
	$kdaba=$db->MysqlOpen();
	if(!empty($_SESSION['level']))	{
			$tahun=date('Y');
			$bulan=date('m');
		
		if($_SESSION['level']=='admin'){
			$sql="select sum(jumlah) as pengeluaran,month(tanggal) as bulan from transaksi where tanggal like '%".$tahun."%' and month(tanggal)='".$bulan."' and jenis_transaksi='Pengeluaran'";
		}
		else{

			$sql="select sum(a.jumlah) as pengeluaran,month(a.tanggal) as bulan from transaksi as a,usaha as b,petani as c where a.id_usaha=b.id_usaha and b.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user']." and a.tanggal like '%".$tahun."%' and month(a.tanggal)= '".$bulan."' and a.jenis_transaksi='Pengeluaran' group by month(a.tanggal);";
		}
	}
	 $hasil=$kdaba->query($sql);
	 return $hasil;
}


?>