<!-- start upper bar -->
<div class="upper-bar">
      <div class="container">
        <div class="row">
          <div class="info col-sm text-center text-sm-left">
            <i class="fa fa-phone"></i> <span>04543332</span>,
            <i class="fa fa-envelope-o"></i> amaalhussien9090@gmail.com
          </div>
      
          </div>
        </div>
      </div>
 <!--end upper bar -->
 <!--navbar start -->
 <nav class="navbar navbar-expand navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <span>Universit</span><span>of Wasit</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="">SingUp</a>
            </li>
            <li class="nav-item">
            <?php

  if(isset($_SESSION['user_name']))
  {
     echo'<a class="nav-link" href="logout.php">logout</a>';
    
    }else
  {
    echo'<a class="nav-link" href="login.php">login</a>';
  }

  ?>
      </li>  
          </ul>
        </div>
      </div>
    </nav>
 <!--end navbar -->

