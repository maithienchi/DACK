<?php 
  require_once 'init.php';

  // Xử lý logic ở đây

 

?>
<?php include 'header.php'; ?>
<div clast="container" class="col-sm-4" >
<h1>Đăng Ký</h1>
<?php if (isset($_POST['displayName']) && isset($_POST['email']) && isset($_POST['password'])): ?>
<?php
    $displayName=$_POST['displayName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    

    $succcess=false;
    $user=findUserByEmail($email);

    if (!$user ){
      
      $newUserId=createUser($displayName,$email,$password);
      // $_SESSION['userId']=$newUserId;
      $succcess=true;
    }
    
?>
<?php if ($succcess): ?>
<div class="alert alert-success" role="alert">
Vui lòng kiểm tra email để kích hoạt tài khoản
</div>
<?php else: ?>
<div class="alert alert-danger" role="alert">
    Đăng ký Ký bại
</div>
<?php endif; ?>
<?php else: ?>
    <form action="register.php" method = "POST" >
    <div class = "form-group">
   <label for="displayName">Họ Tên</label>
    <input type="text" name="displayName" class="form-control" placeholder="Họ Tên" >
    </div>
    <div class = "form-group">
   <label for="email">Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email" >
    </div>

    <div class = "form-group">
    <label for="password">Mật Khẩu</label>
    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
    </div>

    
    <button type="submit" class="btn btn-primary btn-lg">Đăng Ký</button>

    </form>
    </div>
    
<?php endif; ?>
<?php include 'footer.php'; ?>