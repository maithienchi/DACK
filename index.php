<?php 
  require_once 'init.php';

  // Xử lý logic ở đây
  $posts=getNewFeeds();

  // setcookie('PHPSESSID',$cookie_name['PHPSESSID'], time() + (0), "/");
  //var_dump($_COOKIE);
  //echo $currentUser['id'];
  // var_dump($GLOBALS);
?>
<?php include 'header.php'; ?>

<?php if ($currentUser): ?>
<p>Chào mừng <?php echo $currentUser['displayName']; ?> đã trở lại </p>
<form action="create-post.php" method = "POST" >
    <div class = "form-group">
   <label for="content">Tạo bài viết</label>
   <textarea class="form-control" name='content' id="content" rows="3" placeholder="<?php echo $currentUser['displayName']; ?> ơi, bạn đang nghĩ gì?"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Đăng</button>
    </form>

<?php foreach ($posts as $posts) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
      <div class="row">
        <div class="col-sm-0">
          <?php if ($posts['hasAvatar']) : ?>
          <img src="./avatars/<?php echo $posts['userId'] ?>.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;"src="./avatars/<?php echo $posts['userId'] ?>.jpg"> -->
          <?php else : ?>
          <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;"src="no-avatar.jpg"> -->
          <?php endif; ?>
        </div>
        <div class="col-sm">
          <?php echo $posts['displayName'] ?>
        </div>
      </div>
    </h4>
    <p class="card-text">
    <small>Đăng lúc: <?php echo $posts['createdAt'] ?></small>
    <p style ='font-size:18px'><?php echo $posts['content'] ?></p>
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