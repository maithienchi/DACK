<?php
require 'init.php';
//require 'functions.php';
?>
<?php
    include 'header.php';
?>
<h1>Đăng ký</h1>
<?php if(isset($_POST['displayName']) && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['gender']) && isset($_POST['phone'])): ?>
<?php 
$displayName=$_POST['displayName'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$hashPassword = password_hash($password,PASSWORD_DEFAULT);

$success = false;
$user =findUserByEmail($email);

    if(!$user)
    {
        $newUserId=createUser($displayName, $email, $password, $gender, $phone);
        //$_SESSION['userId'] =$newUserId;
        $success =true;
    }
?>
<?php if ($success): ?>
    <div class ="alert alert-success" role="alert">
    Vui lòng kiểm tra mail để kích hoạt tài khoản
    </div>
<?php else : ?>
<div class ="alert alert-danger" role="alert">
    Đăng Ký Thất Bại
</div>
<?php endif; ?>
<?php else : ?>
    <form action="register.php" method = "POST">
    <div class = "form-group">
    <h2 >  <label for="displayName"  >Họ tên</label> </h2>
    <input type="text" class = "form-control" id = "displayName" name = "displayName" placeholder = "Họ tên" >
    </div>
    <div class = "form-group">
    <h2 >  <label for="email"  >Email</label> </h2>
    <input type="email" class = "form-control" id = "email" name = "email" placeholder = "Email" >
    </div>
    <div class = "form-group">
    <label for="password">Mật Khẩu</label>
    <input type="password" class = "form-control" id = "password" name = "password" placeholder = "Mật Khẩu">
    </div>
    <div class ="form-group">
        <label for="email">Gender</label>
        <div>
            <label for="male" class="radio-inline"><input type="radio" name="gender"
            value="m" id="male">Male</label>
            <label for="female" class="radio-inline"><input type="radio" name="gender"
            value="f" id="female">Female</label>
            <label for="others" class="radio-inline"><input type="radio" name="gender"
            value="o" id="others">Others</label>
        </div>
    </div>
    <div class="form-group">
    <label for="phone">Số điện thoại</label>
    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Điền số điện thoại vào đây">
    </div>
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="agree-tos" class="form-check-input">
      Đồng ý điều khoản trang Web
    </label>
  </div>   
    <button type = "submit" class = "btn btn-primary">Đăng Ký</button>
    </form>     
<?php endif; ?>
<?php include 'footer.php'; ?>