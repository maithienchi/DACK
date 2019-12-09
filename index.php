<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!--image-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Team 3XXX</title>
</head>
<body>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  top:50;
  left: 50%;
  transform: translate(80%, 20%);
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
<?php 
  require_once 'init.php';
  //require_once 'functions.php';
  // Xử lý logic ở đây
  //$page='index';
  if ($currentUser) {
    $newFeeds = getNewFeeds();
 }
?>
<?php include 'header.php'; ?>
<h1>Chào bạn đến với mạng xã hội</h1>

<?php if ($currentUser) : ?>
<p>Chào mừng <?php echo $currentUser['displayName'] ?> đã trở lại.</p>
<?php foreach ($newFeeds as $post) : ?>
<div class="card" style="margin-bottom:10px;">
  <div class="card-body">
    <h4 class="card-title">
    <div class="container">        
    <img src="uploads/avatars/<?php echo $post['userId'] ?>.jpg" class="img-circle" alt="Cinque Terre" width="40" height="40"><?php echo $post['userdisplayName'] ?> 
    <p><?php echo $post['content'] ?></p>
      <div class="row">
        <div class="col">
          <?php if ($post['userHasAvatar']) : ?>
          <img class="avatar" src="uploads/avatars/<?php echo $post['userId'] ?>.jpg">
          <?php else : ?>
          <img src="no-avatar.jpg">
          <?php endif; ?>
          </div>
        </div>
      </div>
    </h4>
    <p class="card-text">
    <small>Đăng lúc: <?php echo $post['createdAt'] ?></small>
    </p>
    <i class ='fa fa-thumbs-o-up' data-toggle="tooltip" title="Cảm xúc với status này!" style ='font-size:20px; color:black;'>&ensp;Thích</i>&emsp;
    <i class ='far fa-comment-alt' data-toggle="tooltip" title="Viết bình luận" style ='font-size:20px; color:black;'>&ensp;Bình luận</i>&emsp;
    <i class ='fa fa-share' data-toggle="tooltip" title="Gửi nội dung này đến bạn bè hoặc đăng trên dòng thời gian của bạn" style ='font-size:20px; color:black;'>&ensp;Chia sẻ</i>&emsp;
  </div>
</div>
<?php endforeach; ?>
<?php else: ?>

<?php endif ?>
<?php include 'footer.php'; ?>
</body>
</html>