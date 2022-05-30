<link href="../template/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../template/frame/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../template/frame/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../template/frame/css/sb-admin.css" rel="stylesheet">
<div class="container">
<div class="col-lg-12 text-center">
    <h2 class="section-heading text-uppercase">Sign Up to make an account</h2>
    <h3 class="section-subheading text-muted">Contact us if you encountered any problem</h3>
</div>

<div class="col-sm-4">
  
  <form action="../controller/controlsignup.php" method="post" >
    <div class="form-group">
      <label for="userfdm">Username</label>
      <input class="form-control" id="userfdm" name="username" type="text" aria-describedby="emailHelp" placeholder="Username" maxlength="25">
    </div>
    <div class="form-group">
      <label for="passwordfdm">Password</label>
      <input class="form-control" id="passwordfdm" name="password" type="password" placeholder="Password" maxlength="50">
    </div>
    <div class="form-group">
      <label for="passwordfdm">Retype Password</label>
      <input class="form-control" id="passwordfdm1" name="password1" type="password" placeholder="Password" maxlength="50">
    </div>
        <div class="form-group">
      <label for="passwordfdm">Email</label>
      <input class="form-control" id="email" name="email" type="email" placeholder="email">
    </div>
    <input type="submit" name="Sign Up" class="btn btn-info btn-block" value="Sign Up" />
  </form>
</div>

