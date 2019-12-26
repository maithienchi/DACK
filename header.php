<?php
  if (isset($_POST['search']) && $_POST['search']!="")
  {
    header('Location: search.php?id='.$_POST['search']);
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>FaBo</title>
    <style>
    /* body {
    background-image: url('backgroud2.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    } */
    .img-circle
    {
    border-radius: 50%;
    color: black;
    background-color: #e9ecef;
    text-shadow: 0 0 black;
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
    <nav class="navbar navbar-expand-lg navbar-primary bg-dark ">
  <a class="navbar-brand" href="index.php"><strong>FaBo</strong></a>
  <!-- <a class="nav-item ml-sm-3 ">
  <ion-icon ios="ios-contacts" md="md-contacts" size="large" title="Danh sách bạn bè" ></ion-icon>
  </a>
  <a class="nav-item ml-sm-3 ">
  <ion-icon name="chatboxes" size="large"title="Tin nhắn"></ion-icon>
  </a>
  <a class="nav-item ml-sm-3 mr-sm-3 ">
  <ion-icon name="notifications" size="large" title="Thông báo"></ion-icon>
  </a> -->
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
      <!-- <li class="nav-item <?php echo $page == 'forgot_password' ? 'active' : '' ?>">
              <a class="nav-link" href="forgot_password.php">Quên mật khẩu</a>
      </li> -->
      <?php else: ?>
      <form class="form-inline my-5 my-lg-0" method="POST">
      <input class="form-control mr-sm-1" type="search" name="search" placeholder="Nhập tên, email hoặc số điện thoại" aria-label="Search" style="width:350px">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <!-- <li class="nav-item <?php echo $page == 'friend' ? 'active': ''; ?>">
        <a class="nav-link" href="friend.php">Bạn bè<span class="sr-only">(current)</span></a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Bạn Bè
      </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="friend.php">Danh sách bạn bè</a>
          <a class="dropdown-item" href="YeuCauKetBan.php">Lời mời kết bạn</a>
          <a class="dropdown-item" href="YeuCauDaGui.php">Yêu cầu kết bạn đã gửi</a>
        </div>
      </li>
      <li class="nav-item <?php echo $page == 'Update-Profile' ? 'active': ''; ?>">
        <a class="nav-link" href="message.php">Tin Nhắn<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $page == 'Update-Profile' ? 'active': ''; ?>">
        <a class="nav-link" href="Update-Profile.php">Thông Báo<span class="sr-only">(current)</span></a>
      </li>
      <!-- </li><li class="nav-item <?php echo $page == 'change-password' ? 'active': ''; ?>">
        <a class="nav-link" href="change-password.php">Đổi mật khẩu<span class="sr-only">(current)</span></a>
      </li> -->
      <?php if($currentUser['avatar']): ?>
    <img src ="avatar.php?id=<?php echo $currentUser['id']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">
    <?php else: ?>
    <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
    <?php endif;?>
      <!-- <li class="nav-item <?php echo $page == 'logout' ? 'active': ''; ?>">
        <a class="nav-link" href="logout.php">Đăng Xuất <?php echo $currentUser ? ' ('. $currentUser['displayName'].')' :'' ?>  <span class="sr-only">(current)</span></a>
      </li> -->
     
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $currentUser ? ' ('. $currentUser['displayName'].')' :'' ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="TrangCaNhan.php">Trang cá nhân</a>
          <a class="dropdown-item" href="change-password.php">Đổi mật khẩu</a>
          <a class="dropdown-item" href="Update-Profile.php">Cài đặt</a>
          <a class="dropdown-item" href="Delete_Account.php">Xóa tài khoản</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Đăng Xuất <?php echo $currentUser ? ' ('. $currentUser['displayName'].')' :'' ?></a>
          <a class="dropdown-item" href="About.php">About</a>
        </div>
      </li>
      
      <?php endif; ?>
  </div>
</nav>