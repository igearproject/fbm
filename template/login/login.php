<div class="container">
<div class="col-lg-12 text-center">
    <h2 class="section-heading text-uppercase">Login To Account</h2>
    <h3 class="section-subheading text-muted">Contact us if you encountered any problem</h3>
</div>

<div class="col-sm-4">
  <?php 
  if(isset($_GET['op'])){
    if($_GET['op']=="f"){
      echo('
          <div class="alert alert-danger" class="col-sm-8" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Username or Password False
          ');
    }
  }
  ?>
  <form action="controller/controllogin.php?op=in" method="post" >
    <div class="form-group">
      <label for="userfdm">Username</label>
      <input class="form-control" id="userfdm" name="userfdm" type="text" aria-describedby="emailHelp" placeholder="Username">
    </div>
    <div class="form-group">
      <label for="passwordfdm">Password</label>
      <input class="form-control" id="passwordfdm" name="passwordfdm" type="password" placeholder="Password">
    </div>
    <input type="hidden" name="op" value="in" />
    <input type="submit" name="login" class="btn btn-info btn-block" value="Login" />
  </form>
  <div class="text-center">
    <a class="d-block small mt-3" href="menu/signup.php">Register an Account</a>
  </div>
</div>
