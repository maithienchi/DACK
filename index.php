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
   <label for="content">Nội dung</label>
   <textarea class="form-control" name='content' id="content" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Đăng</button>
    </form>

<?php foreach ($posts as $posts) : ?>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
      <div class="row">
        <div class="col">
          <?php if ($posts['hasAvatar']) : ?>
          <img style="width: 150px;"src="./avatars/<?php echo $posts['userId'] ?>.jpg">
          <?php else : ?>
          <img style="width: 150px;"src="no-avatar.jpg">
          <?php endif; ?>
        </div>
        <div class="col-11">
          <?php echo $posts['displayName'] ?>
        </div>
      </div>
    </h4>
    <p class="card-text">
    <small>Đăng lúc: <?php echo $posts['createdAt'] ?></small>
    <p><?php echo $posts['content'] ?></p>
    </p>
  </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<h1>Halo everyone well com to Mai Thiện Chí Lập trình web 1</h1>
<?php endif ?>
<?php include 'footer.php'; ?>