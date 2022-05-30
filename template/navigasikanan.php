<div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php?page=dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile Petani">
          <a class="nav-link" href="index.php?page=profile">
            <i class="fa fa-fw  fa-user-md"></i>
            <span class="nav-link-text">Profile Petani</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bisnis">
          <a class="nav-link" href="index.php?page=business">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
            <span class="nav-link-text">Bisnis</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Lahan">
          <a class="nav-link" href="index.php?page=field">
            <i class="fa fa-fw fa-map-marker"></i>
            <span class="nav-link-text">Lahan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transaksi">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw  fa-money"></i>
            <span class="nav-link-text">Transaksi</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            
            <li>
              <a href="index.php?page=allt">All</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Alat">
          <a class="nav-link" href="index.php?page=alat">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Alat</span>
          </a>
        </li>
        <?php
        if($_SESSION['level']=='admin'){
          echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link" href="index.php?page=userfbm">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">User</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Regional">
          <a class="nav-link" href="index.php?page=regional">
            <i class="fa fa-fw fa-globe fa-spin"></i>
            <span class="nav-link-text">Regional</span>
          </a>
        </li>';
        }
        ?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#">
            <i class="fa fa-fw fa-user"></i><?php echo'Welcome '.$_SESSION['user'];?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>