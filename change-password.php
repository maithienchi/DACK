<?php

require 'init.php';
if(!$currentUser){
    header('Location: index.php');
}
//require 'functions.php';
?>

<?php
    include 'header.php';
?>
<h1>Đổi mật khẩu</h1>
<?php if(isset($_POST['currentPassword']) && isset($_POST['password'])): ?>
<?php 
$password = $_POST['password'];
$currentPassword = $_POST['currentPassword'];

$success = false;


if(password_verify($currentPassword,$currentUser['password'])&& ($password !=$currentPassword)) 
{
    UpdateUserPassword($currentUser['id'],$password);
    $success =true;
}

?>
<?php if ($success): ?>
<?php header('Location: index.php');?>
<?php else : ?>
<div class ="alert alert-danger" role="alert">Đổi mật khẩu thất bại</div>
<?php endif; ?>
<?php else : ?>

<form action="change-password.php" method = "POST">
    <div class = "form-group">
    <h2> <label for="currentPassword">Mật Khẩu hiện tại</label> </h2>
    <input type="password" class = "form-control" id = "currentPassword" name = "currentPassword" placeholder = "Mật Khẩu hiện tại">
    </div>
    <div class = "form-group">
    <h2> <label for="password">Mật Khẩu mới</label> </h2>
    <input type="password" class = "form-control" id = "password" name = "password" placeholder = "Mật khẩu mới ">
    </div>

    
    <p><button type = "submit" class = "btn btn-primary">Đổi mật khẩu</button> </p>

    </form>
    
<?php endif; ?>
<?php include 'footer.php'; ?>