 <link href="../template/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../template/frame/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../template/frame/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../template/frame/css/sb-admin.css" rel="stylesheet">
<?php
require "database.php";
$db=new db();
function InputDataUser($username, $password, $email){
		global $db;
		$con=$db->MySqlOpen();
		$sql="INSERT INTO user (`id_user`,`username`,`password`, `email`) VALUES (null,'$username', '$password', '$email');";
		$hasil=$con->query($sql);
		return $hasil;
			}

	if($_POST['password1']==$_POST['password']){

		$inptdata=InputDataUser($_POST['username'],$_POST['password'],$_POST['email']);
		if($inptdata){

			echo('<div class="alert alert-success">Registered Succesfully</div>');
			 header('Refresh: 3; URL=../home.php');

		} else {

			echo('<div class="alert alert-danger">Failed to register</div>');
				header('Refresh: 3; URL=../menu/signup.php');
		}

	}
		else {	
		echo('<div class="alert alert-danger">Failed to register</div>');
			header('Refresh: 3; URL=../menu/signup.php');
	}
	
	



?>