<link href="./template/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<?php
session_start();
$kdbpdo=new PDO('mysql:host=localhost;dbname=db_fbm',"root","");

$nmuser = $_POST['userfdm'];
$psw = $_POST['passwordfdm'];
$op = $_GET['op'];
if($op=="in"){
	$cek = $kdbpdo->query("SELECT * FROM user WHERE username='$nmuser' AND password='$psw' AND status='aktif' ");
	if($cek->rowCount()==1){
	$c = $cek->fetch();
	$_SESSION['nmpetani'] = $c['nmpetani'];
	$_SESSION['user'] = $c['username'];
	$_SESSION['level'] = $c['level_user'];
	$_SESSION['id_user'] = $c['id_user'];
	header("location:../index.php");
		
}else{
	header("location:../home.php?op=f");
}
}else if($op=="Logout"){
unset($_SESSION['user']);
unset($_SESSION['level']);
unset($_SESSION['nmpetani']);
unset($_SESSION['id_user']);
header("location:../index.php");
}
?>