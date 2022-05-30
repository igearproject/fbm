<?php
session_start();
if(!isset($_SESSION['user'])){
header("location:home.php");
}
require('controller/database.php');
$db=new db();
require('controller/uploadfile.php');
$up=new upload();
?>
<!DOCTYPE html>
<html lang="en">
<!--Sistem Menu-->


<head>
  <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
</style>
<script type="text/javascript" src="framework/Chartjs/Chart.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FBM - Farmer Business Management</title>
  <!-- Bootstrap core CSS-->
  <link href="template/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="template/frame/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="template/frame/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="template/frame/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="home.php">Farmer Business Management</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--tobol navigasi kanan-->
    <?php
      include('template/navigasikanan.php'); 
    ?>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      
      <!-- Isi Dari Website-->

      <?php
      if(!empty($_GET['page'])){
        $p=$_GET['page'];
        switch($p){
          case 'dashboard' : {
            include ('menu/dasboard.php');
            break;
          }
          case 'profile' : {
            include ('menu/profile.php');
            break;
          }
          case 'business' : {
            include ('menu/business.php');
            break;
          }
          case 'profileedit' : {
            include ('menu/profiledit.php');
            break;
          }
          case 'field' : {
            include ('menu/field.php');
            break;
          }
          case 'allt' : {
            include ('menu/alltransaksi.php');
            break;
          }
          case 'alat' : {
            include ('menu/alat.php');
            break;
          }
          case 'export' : {
            include ('menu/export.php');
            break;
          }
          case 'userfbm' : {
            if($_SESSION['level']=='admin'){
              include ('menu/user.php');
            }
            else{
              $db->Peringatan('Access Denied :P','danger');
            }
            
            break;
          }
          case 'regional' : {
            if($_SESSION['level']=='admin'){
              include ('menu/regional.php');
            }
            else{
              $db->Peringatan('Access Denied :P','danger');
            }
            
            break;
          }
          default:{
            include ('menu/profile.php');
            break;
          }

        }
      }else{
        include ('menu/profile.php');
      }
      
      ?>


    <?php
      include('template/footer.php');
    ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="controller/controllogin.php?op=Logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <?php
      function rupiah($nilai){
        echo $hasil="Rp. ".number_format($nilai,2,',','.');
      } 
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="template/frame/vendor/jquery/jquery.min.js"></script>
    <script src="template/frame/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="template/frame/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="template/frame/vendor/chart.js/Chart.min.js"></script>
    <script src="template/frame/vendor/datatables/jquery.dataTables.js"></script>
    <script src="template/frame/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="template/frame/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="template/frame/js/sb-admin-datatables.min.js"></script>
    <script src="template/frame/js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
