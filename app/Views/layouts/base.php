<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result System</title>
  <link rel="stylesheet" href="<?=base_url("assets/bootstrap/css/bootstrap.min.css")?>">
</head>
<body>
  <div class="container-fluid">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url("dashboard");?>">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=base_url("/");?>">Home</a>
        </li>
        <?php if(session()->has("logged_user")):?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?=$this->renderSection("note");?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Edit</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="<?=base_url("avatar");?>">Upload Avatar</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="<?=base_url("changepassword");?>">Change Password</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="<?=base_url("loginactivity");?>">Login activity</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="<?=base_url("logout");?>">LogOut</a></li>
          </ul>
        </li>
          
         </li>
          <?php else:?>
            <li class="nav-item">
          <a class="nav-link" href="<?=base_url("register");?>">Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url("login");?>">Login</a>
        </li>
        <?php endif;?>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Details
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
  </div>
</nav>
  </div>
  <main class="container-fluid">
   <?=$this->renderSection("body");?>
  </main>
<script src="<?=base_url("assets/bootstrap/js/bootstrap.min.js")?>"></script>
</body>
</html>