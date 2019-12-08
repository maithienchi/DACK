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
<h1>Lấy lại mật khẩu</h1>
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
<div class ="alert alert-danger" role="alert">Email không hợp lệ</div>
<?php endif; ?>
<?php else : ?>
<form action="userAccount.php" method="post">
    <input type="password" name="password" placeholder="PASSWORD" required="">
    <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required="">
    <div class="send-button">
    <input type="hidden" name="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>"/>
    <input type="submit" name="resetSubmit" value="RESET PASSWORD">
    </div>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>