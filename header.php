<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chào mừng các bạn đến với mạng xã hội</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Trang chủ</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <?php if(!$currentUser) : ?>
      <li class="nav-item <?php echo $page == 'login' ? 'active' :'' ?>" >
        <a class="nav-link" href="login.php">Đăng Nhập</a>
    </li>
    <li class="nav-item"  <?php echo $page == 'register' ? 'active' :'' ?> >
        <a class="nav-link" href="register.php">Đăng Ký </a>
     </li>
     <?php endif; ?>
     </ul>
    <?php if ($currentUser) : ?>
      <form class="navbar-form navbar-left" action="/action_page.php">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
     <ul class="nav navbar-nav">
     <li class="active"><a href="post.php">Cập nhập trạng thái</a></li>
    </ul>
    <ul class="nav navbar-nav navbar">
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li><i class="fas fa-user-friends" style="font-size:24px; color: white; margin: 2px; padding: 10px"></i></li>
    <li> <i class="fa fa-comment" style="font-size:24px; color: white; margin: 2px; padding: 10px"></i></li>
    <li> <i class="fa fa-bell" style="font-size:24px;color:White; margin: 2px; padding: 10px"></i></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $currentUser['displayName'] ?><span class="caret"></span>
      </a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Đổi thông tin cá nhân</a></li>
          <li><a href="change-password.php">Đổi mật khẩu</a></li>
          <li><a href="logout.php">Đăng Xuất</a></li>
        </ul>
      </li>
    </ul>
    <?php endif; ?>
  </div>
</nav>  