<?php

include('controller/exportcontroller.php');
require('framework/fpdf/html_table.php');
$dusaha=$db->CariData('usaha','id_usaha',$_POST['id_usaha']);
foreach ($dusaha as $datausaha) {
	$namausaha=$datausaha['nm_usaha'];
}

function rupiah($nilai){
    $hasil="Rp. ".number_format($nilai,2,',','.');
    return($hasil);
}

function Header1()
{
	global $pdf;
	global $namausaha;
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40);
	$pdf->Cell(110,8,'DATA TRANSAKSI',0,1,'C');   	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(40);	
	$pdf->Cell(110,6,$namausaha,0,1,'C');
	$pdf->SetFont('Arial','',7);    
	//$pdf->Cell(40);
	
	$pdf->Line(10, 30, 200, 30);
	$pdf->Ln();
	
}
function Footer2()
{
	global $pdf;
	//$pdf->Line(10, 283, 200, 283);
	$pdf->SetY(265);
	$pdf->SetFont('Arial','I',7);
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}'.', date '.date('d/m/Y').', Farmer Bussiness Managemen - '.date('Y'),0,0,'R');
}

$data=ViewDataTransaksiPerUserUsaha();

$jumlahpengeluaran=ViewJumlahTransaksi('Pengeluaran',$_POST['id_usaha']);
foreach ($jumlahpengeluaran as $djpengeluaran) {
}
$jumlahpemasukan=ViewJumlahTransaksi('Pemasukan',$_POST['id_usaha']);
foreach ($jumlahpemasukan as $djpemasukan) {
}


$pdf=new PDF();
$pdf->AddPage();
Header1();

$pdf->SetFont('Arial', '', 12);
$pdf->Ln();

$html='<table border="0">
<tr>
<td width="210" bgcolor="#D0D0FF" height="60">Nama Transaksi</td>
<td width="180" bgcolor="#D0D0FF" height="60">Jenis Transaksi</td>
<td width="180" bgcolor="#D0D0FF" height="60">Tanggal</td>
<td width="180" bgcolor="#D0D0FF" height="60">Jumlah</td>
</tr>

';
foreach ($data as $row) {
	$uang=rupiah($row['jumlah']);
	$html.='<tr>
	<td width="210"  height="30">'.$row['nm_transaksi'].'</td>
	<td width="180"  height="30">'.$row['jenis_transaksi'].'</td>
	<td width="180"  height="30">'.$row['tanggal'].'</td>
	<td width="180"  height="30">'.$uang.'</td>
	</tr>

	';
}
$JPengeluaran=rupiah($djpengeluaran['jumlahp']);
$html.='<tr>
		<td width="210" bgcolor="#D24D57" height="60">.</td>
		<td width="180" bgcolor="#D24D57" height="60">.</td>
		<td width="180" bgcolor="#D24D57" height="60">Jumlah Pengeluaran</td>
		<td width="180" bgcolor="#D24D57" height="60">'.$JPengeluaran.'</td>
		</tr>';
$JPemasukan=rupiah($djpemasukan['jumlahp']);
$html.='<tr>
		<td width="210" bgcolor="#22A7F0" height="60">.</td>
		<td width="180" bgcolor="#22A7F0" height="60">.</td>
		<td width="180" bgcolor="#22A7F0" height="60">Jumlah Pemasukan</td>
		<td width="180" bgcolor="#22A7F0" height="60">'.$JPemasukan.'</td>
		</tr>';
$JKeseluruhan=rupiah($djpemasukan['jumlahp']-$djpengeluaran['jumlahp']);
$html.='<tr>
		<td width="210" bgcolor="#F4B350" height="60">.</td>
		<td width="180" bgcolor="#F4B350" height="60">.</td>
		<td width="180" bgcolor="#F4B350" height="60">Jumlah Pemasukan</td>
		<td width="180" bgcolor="#F4B350" height="60">'.$JKeseluruhan.'</td>
		</tr>';

$html.='</table>';

$pdf->WriteHTML($html);
Footer2();
$pdf->Output();
?>