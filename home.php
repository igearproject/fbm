<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FBM - Farmer Business Management</title>

    <!-- Bootstrap core CSS -->
    <link href="template/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="template/frame/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="template/frame/css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <?php include('template/mainhomenavbar.php');?>

    <!-- Header -->
    <?php include('template/mainhomeheader.php');?>
    <?php
    if(empty($_SESSION['user'])){
        echo'<section id="login">';
        include('template/login/login.php');
        echo'</section>';        
    }
    ?>
    


    <!-- About -->
    <section id="about">
      <?php include('template/mainhomeabout.php');?>
    </section>

    <!-- Team -->
    <section class="bg-light" id="team">
      <?php include('template/mainhometeam.php');?>
    </section>

    <!-- Contact -->
    <section id="contact">
      <?php include('template/mainhomecontact.php');?>
    </section>

    <!-- Footer -->
    <?php include('template/mainhomefooter.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="template/frame/vendor/jquery/jquery.min.js"></script>
    <script src="template/frame/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="template/frame/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="template/frame/js/jqBootstrapValidation.js"></script>
    <script src="template/frame/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="template/frame/js/agency.min.js"></script>

  </body>

</html>
