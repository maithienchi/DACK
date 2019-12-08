<?php
require_once 'init.php';

if (!$currentUser) {
  header('Location: index.php');
  exit();
}

$displayName=$currentUser['displayName'];
$success = true;

// Kiểm tra người dùng có nhập tên
if (isset($_POST['displayName'])) {
  if (strlen($_POST['displayName']) > 0) {
    $displayName=$_POST['displayName'];
    $currentUser['displayName'] = $displayName;
    updateUserProfile($currentUser);
  } else {
    $success = false;
  }

  if(isset($_FILES['avatar'])) {
      $fileName = $_FILES['avatar']['name'];
      $fileSize = $_FILES['avatar']['size'];
      $fileTemp = $_FILES['avatar']['tmp_name'];
      $filePath = './avatars/' . $currentUser['id'] . '.jpg';
       move_uploaded_file($fileTemp, $filePath);
      $newImage = resizeImage($filePath, 480, 480);
      imagejpeg($newImage, $filePath);
      $currentUser['hasAvatar'] = 1;
      updateUserProfile($currentUser);
      header('Location: index.php');
  
  }
}

?>

<?php include 'header.php' ?>
<h1>Quản lý thông tin cá nhân</h1>
<?php if (!$success) : ?>
<div class="alert alert-danger" role="alert">
  Vui lòng nhập đầy đủ thông tin!
</div>
<?php endif; ?>
<form action="Update-Profile.php" method = "POST" enctype="multipart/form-data">
    <div class = "form-group">
    <label for="displayName">Họ Tên</label>
    <input type="text" name="displayName" class="form-control" placeholder="Họ Tên" value= "<?php echo $currentUser['displayName']; ?>">
    </div>
    <div class="form-group">
    <label for="avatar">Ảnh đại diện</label>
    <input type="file" class="form-control-file" name="avatar" id="avatar" >
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Cập nhật thông tin cá nhân</button>
    </form>
<?php include 'footer.php'; ?>


