<?php 
  require_once 'init.php';
  // Xử lý logic ở đây
  $posts=getNewFeedsCaNhan($currentUser['id']);
  // setcookie('PHPSESSID',$cookie_name['PHPSESSID'], time() + (0), "/");
  //var_dump($_COOKIE);
  //echo $currentUser['id'];
  // var_dump($GLOBALS);
  $privacy="";
  $privacy1="";
  $privacy2="";
  if(isset($_POST['content']) && $_POST['content']!="" )
  {
    if ( isset( $_FILES["image"] ) && !empty( $_FILES["image"]["name"] ) ) {
      if ( is_uploaded_file( $_FILES["image"]["tmp_name"] ) && $_FILES["image"]["error"] == 0)
      {
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTemp = $_FILES['image']['tmp_name'];
      // $filePath = './avatars/' . $currentUser['id'] . '.jpg';
      //  move_uploaded_file($fileTemp, $filePath);
        $newImage = resizeImage($fileTemp, 480, 480);
        // imagejpeg($newImage, $filePath);
        ob_start();
        imagejpeg($newImage);
        $image = ob_get_contents();
        ob_end_clean();

        createPost($currentUser['id'],$_POST['content'],$image,$_POST['privacy']);
        header('Location: TrangCaNhan.php');
      }
    }
  }
  if(isset($_POST['deletePost']))
  {
    deletePostWithId($_POST['deletePost']);
    header('Location:TrangCaNhan.php');
  } 
  if(isset($_POST['privacy']) && $_POST['updatePost']!="")
  {
    UpdatePostById($_POST['updatePost'],$_POST['privacy']);
    header('Location:TrangCaNhan.php');
  }
?>
<?php include 'header.php'; ?>

<?php if ($currentUser): ?>
<p>Chào mừng <?php echo $currentUser['displayName']; ?> đã trở lại </p>
<h3>Thông Tin Cá Nhân</h3>
<?php if($currentUser['avatar']): ?>
    <img src ="avatar.php?id=<?php echo $currentUser['id']; ?>"  alt="Cinque Terre" >
    <?php else: ?>
    <img src="no-avatar.jpg"  alt="Cinque Terre" >
    <?php endif;?>
<li>
    <b>Họ Tên: </b><?php echo $currentUser['displayName']; ?><br>
</li>
<li>
    <b>Email: </b><?php echo $currentUser['email']; ?>
</li>
<li>
    <b>Giới tính: </b><?php echo $currentUser['gender']; ?>
</li>
<li>
    <b>Ngày Sinh: </b><?php echo $currentUser['NamSinh']; ?>
</li>
<li>
    <b>Số điện thoại: </b><?php echo $currentUser['phone']; ?>
</li>
<form action="Update-Profile.php">
    <button type="submit" style="width:250px">Chỉnh sửa chi tiết</button>
</form>

<form  method = "POST" enctype="multipart/form-data">
    <div class = "form-group">
   <label for="content"><br>Tạo bài viết</label>
   <textarea class="form-control" name='content' id="content" rows="3" placeholder="<?php echo $currentUser['displayName']; ?> ơi, bạn đang nghĩ gì?"></textarea>
    </div>
    <select name="privacy"> 
    <option value="Công khai">Công khai</option> 
    <option value="Bạn bè">Bạn bè</option> 
    <option value="Chỉ mình tôi">Chỉ mình tôi</option> 
    </select>
    <input type="file" class="form-control-file" name="image" id="image" >
    <button type="submit" class="btn btn-primary btn-lg">Đăng</button>
    </form>

<?php foreach ($posts as $post) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
      <div class="row">
        <div class="col-sm-0">
          <?php if ($post['hasAvatar']) : ?>
          <img src ="avatar.php?id=<?php echo $post['userId']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;" src ="avatar.php?id=<?php echo $post['userId']; ?>"> -->
          <!-- <img style="width: 150px;"src="./avatars/<?php echo $post['userId'] ?>.jpg"> -->
          <?php else : ?>
          <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;"src="no-avatar.jpg"> -->
          <?php endif; ?>
        </div>
        <div class="col-sm">
          <?php echo $post['displayName'] ?>
        </div>
        <form method="POST">
        <button class="img-circle" style ='font-size:10px' align="right" id="deletePost" name="deletePost" value="<?php echo $post['id']; ?>">xóa</button>
        </form>
      </div>
    </h4>
    <p class="card-text">
    <div class="row">
    <small>Đăng lúc: <?php echo $post['createdAt'] ?></small>&nbsp;
  <!-- <ion-icon name="lock" size="normal" title="Thông báo"></ion-icon> -->
  <!-- value="17" selected="1" -->
  <ion-icon name="lock" size="normal" title="Thông báo"></ion-icon>
  <?php if($post['privacy'] =='Công khai'){
    $privacy='selected="1"';
  }
  else if($post['privacy'] =='Bạn bè'){
    $privacy1='selected="1"';
  }
  else{
    $privacy2='selected="1"';
  }
  ?>
      <form method="POST">
      <select style ='font-size:10px' name="privacy" >
        <option style ='font-size:10px' value="Công khai" <?php echo $privacy; ?>>Công khai</option> 
        <option style ='font-size:10px' value="Bạn bè" <?php echo $privacy1; ?>>Bạn bè</option> 
        <option style ='font-size:10px' value="Chỉ mình tôi"<?php echo $privacy2; ?>>Chỉ mình tôi</option> 
        </select>
        <button style ='font-size:10px'class="img-circle"  name="updatePost" value="<?php echo $post['id']; ?>">cập nhật</button>
      </form>
  <?php 
  $privacy="";
  $privacy1="";
  $privacy2="";
  ?>
  </div>
    <p style ='font-size:18px'><?php echo $post['content'] ?></p>
    <?php if($post['image']): ?>
    <img src ="imagePost.php?id=<?php echo $post['id']; ?>"  alt="Cinque Terre" >
    <?php endif;?>
    </p>
    <i class ='fa fa-thumbs-o-up' data-toggle="tooltip" title="Cảm xúc với status này!" style ='font-size:20px; color:black;'>&ensp;Thích</i>&emsp;
    <i class ='far fa-comment-alt' data-toggle="tooltip" title="Viết bình luận" style ='font-size:20px; color:black;'>&ensp;Bình luận</i>&emsp;
    <i class ='fa fa-share' data-toggle="tooltip" title="Gửi nội dung này đến bạn bè hoặc đăng trên dòng thời gian của bạn" style ='font-size:20px; color:black;'>&ensp;Chia sẻ</i>&emsp;
  </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<h1>Chào mừng đến với trang mạng xã hội FaBo</h1>
<?php endif ?>
<?php include 'footer.php'; ?>