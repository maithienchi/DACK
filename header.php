<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>FaBo</title>
    <style>
    .img-circle
    {
    border-radius: 50%;
    color: white;
    }
    .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0);
  transition: 0.3s;
  width: 100%;
  top: 0%;
  left: 0%;
  transform: translate(0%, 20%);
  }

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
    </style>
  </head>
  <body>
  
  <div class="container">
    <h1>Mạng xã hội FaBo</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">FaBo</a>
  <a class="nav-item ml-sm-3 ">
  <ion-icon ios="ios-contacts" md="md-contacts" size="large" title="Danh sách bạn bè" ></ion-icon>
  </a>
  <a class="nav-item ml-sm-3 ">
  <ion-icon name="chatboxes" size="large"title="Tin nhắn"></ion-icon>
  </a>
  <a class="nav-item ml-sm-3 mr-sm-3 ">
  <ion-icon name="notifications" size="large" title="Thông báo"></ion-icon>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if (!$currentUser): ?>
      <li class="nav-item <?php echo $page == 'register' ? 'active': ''; ?>">
        <a class="nav-link" href="register.php">Đăng Ký <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $page == 'login' ? 'active': ''; ?>">
        <a class="nav-link" href="login.php">Đăng Nhập <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $page == 'forgot_password' ? 'active' : '' ?>">
              <a class="nav-link" href="forgot_password.php">Quên mật khẩu</a>
      </li>
      <?php else: ?>
      <form class="form-inline my-5 my-lg-0">
      <input class="form-control mr-sm-1" type="search" placeholder="Search" aria-label="Search" style="width:350px">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <li class="nav-item <?php echo $page == 'Update-Profile' ? 'active': ''; ?>">
        <a class="nav-link" href="Update-Profile.php">Cá nhân<span class="sr-only">(current)</span></a>
      </li>
      <!-- </li><li class="nav-item <?php echo $page == 'change-password' ? 'active': ''; ?>">
        <a class="nav-link" href="change-password.php">Đổi mật khẩu<span class="sr-only">(current)</span></a>
      </li> -->
      <img src="avatars/1.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
      <!-- <li class="nav-item <?php echo $page == 'logout' ? 'active': ''; ?>">
        <a class="nav-link" href="logout.php">Đăng Xuất <?php echo $currentUser ? ' ('. $currentUser['displayName'].')' :'' ?>  <span class="sr-only">(current)</span></a>
      </li> -->
     
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Trang cá nhân</a>
          <a class="dropdown-item" href="change-password.php">Đổi mật khẩu</a>
          <a class="dropdown-item" href="#">Cài đặt</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Đăng Xuất</a>
        </div>
      </li>
      <?php endif; ?>
    
  </div>
</nav>