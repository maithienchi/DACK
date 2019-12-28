<?php 
    require_once 'init.php';
    $PostNewCount = $_POST['PostNewCount'];
    $posts=getNewFeedsCaNhan($_GET['id'],$PostNewCount);
    $profile = findUserById($_GET['id']);
    $friends = getFriends($currentUser['id']);
    $isFriend = false;
    foreach ($friends AS $friend) {
    if ($friend['id'] == $profile['id']) {
        $isFriend = true;
    }
    }
    $isFollow = isFollow($currentUser['id'], $profile['id']);
    $isRequest = isFollow($profile['id'], $currentUser['id']);
    $KiemTraFollow=KiemTraFollow($currentUser['id'], $profile['id']);


    $TheoDoi="";
    $MauTheoDoi = "";

    if (isset($_POST['NhanTin']))
    {
    header('Location: conversation.php?id=' . $_GET['id']);
    }
    if(isset($_POST['TheoDoi']))
    {
    if($KiemTraFollow){
        HuyFollow($currentUser['id'], $profile['id']);
    }
    else {
        Follow($currentUser['id'], $profile['id']);
    }
    header('Location: wall.php?id=' . $_GET['id']);
    }

?>
<?php foreach ($posts as $post) : ?>
<?php if ($isFriend): ?> 
  <?php if($post['privacy']=='Công khai'|| $post['privacy']=='Bạn bè' ): ?>  
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
          <?php if ($post['hasAvatar']): ?>
          <img src ="avatar.php?id=<?php echo $post['userId']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;" src ="avatar.php?id=<?php echo $post['userId']; ?>"> -->
          <!-- <img style="width: 150px;"src="./avatars/<?php echo $post['userId']; ?>.jpg"> -->
          <?php else : ?>
          <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;"src="no-avatar.jpg"> -->
          <?php endif; ?>
        <!-- <div class="col-sm"> -->
        <?php echo $post['displayName']; ?>
        </h4>
        <!-- </div>
        </div>
        </div>
        </h4> -->
        <p class="card-text">
        <small>Đăng lúc: <?php echo $post['createdAt'] ?></small>
        <label style ='font-size:10px'>(<?php echo $post['privacy'].')'; ?></label>
        <p style ='font-size:18px'><?php echo $post['content'] ?></p>
        <?php if($post['image']): ?>
        <img src ="imagePost.php?id=<?php echo $post['id']; ?>"  alt="Cinque Terre" >
        <?php endif;?>
        </p>
        

        <?php
      $countlike=DemLike($post['id']);
      $countcommemnt=getcountcomments($post['id']);
    ?>
    <div class="card-body">
    <hr>
        <div class="row">
            
            <div class="btn-group" style="position: relative;bottom:6px;left:23px">
            <?php if (KiemTraLike($post['id'],$currentUser['id'])): ?>
            <a class="btn"name="unlike"id="unlike"href="likeCaNhan.php?type=unlike&id=<?php echo $post['id'] ?>"style='color:blue'><i style='font-size:20px' class='far fa-thumbs-up'data-toggle="tooltip" title="Cảm xúc của bạn với status này!!"></i> Thích  <span class="badge badge-primary  rounded-circle" ><?php echo implode(" ",$countlike);?></span></a>
            <?php else:?>
            <a class="btn"name="like"id="like"href="likeCaNhan.php?type=like&id=<?php echo $post['id'] ?>"style='color:black'><i style='font-size:20px' class='far fa-thumbs-up'data-toggle="tooltip" title="Cảm xúc của bạn với status này!!"></i> Thích  <span class="badge badge-light  rounded-circle"><?php echo implode(" ",$countlike);?></span></a>
            <?php endif ?>
            </div>&emsp;&emsp;
            
            <div>
            <h9 aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='far fa-comment-alt'data-toggle="tooltip" title="Cảm nghĩ của bạn về bài viết này!"></i> Bình luận<span class="badge badge-light  rounded-circle"><?php echo implode(" ",$countcommemnt);?></span></h9>
            </div>&emsp;&emsp;
            <div>
                <h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style="font-size:20px" class="fa fa-share" data-toggle="tooltip" title="Chia sẻ với bạn bè" aria-hidden="true"></i><span class="sr-only">Chia sẻ với bạn bè</span> Chia sẻ </h9>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Chia sẻ ngay (Công khai)</a>
                    <a class="dropdown-item" href="#">Chia sẻ ...</a>
                    <a class="dropdown-item" href="#">Gửi dưới dạng tin nhắn</a>
                    <a class="dropdown-item" href="#">Chia sẻ trên dòng thời gian với bạn bè</a>
                    <a class="dropdown-item" href="#">Chia sẻ lên trang</a>
                </div>
            </div>
        </div>
    <hr>
    <?php $getcomment=getcomment($post['id']);
    ?>
    <?php if(usercommentd($post['id'],$currentUser['id'])): ?>
    <div class="target" style="height:200px;overflow:scroll;" >
        <?php foreach ($getcomment as $postss):?>
            
        <div class="card" >
        <div class="card-body">
                <h5 class="card-title">
                    <?php if($postss['avatar']):?> 
                      <img src ="avatar.php?id=<?php echo $postss['userId']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">  
                    <?php else: ?>
                    <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
                    <?php endif ?> 
                    <a href="profile.php?id=<?php echo $postss['userId'] ?>"><div style="position: absolute; left:80px;top:20px " ><?php echo $postss['displayName']?> </div> </a>          
                  </h5> 

                  <small><p class="card-text"style="position: absolute; left:80px;top:50px" > Bình luận lúc: 
                    <?php echo $postss['createdAt'];?>
                </p></small>
                <p >
                    <?php echo $postss['content'];?>
                </p>
                <div class="col"style="text-align: right;position: absolute; left:8px;top:8px ">
                <form method="post">
                <button  type="submit" name="deletecomment" value = <?php echo $postss['id']; ?>  class="btn btn-danger" >Xóa</button>   
                </form>

                <?php 
                if(isset($_POST['deletecomment']))
                {
                    $value_commnet=$_POST['deletecomment'];
                    
                    deletecomment($value_commnet);
                    header("Location: index.php");
                    }
                ?>
                  
            </div>  
            </div>  
            </div>
        <?php endforeach ?>
                        </div>
    <?php else:?>
            <div></div>
    <?php endif?>
    <form action="upcomment1.php?type=upcommentindex&id=<?php echo $post['id'] ?>" method="POST" >
    <div class="form-group">
        <textarea style="height:50px" class="form-control" name="contents" id="contents" rows="3"placeholder="Thêm bình luận..."></textarea>                                
    </div>        
    <button type="submit" class="btn btn-primary" name="upcomment">comment</button>
    </form>	
</div>



      </div>
    </div>
      <?php endif; ?>
<?php else: ?> 
  <?php if($post['privacy']=='Công khai'): ?>
    <div class="card" style="margin-bottom: 10px;">
  <div class="card-body">
    <h4 class="card-title">
          <?php if ($post['hasAvatar']): ?>
          <img src ="avatar.php?id=<?php echo $post['userId']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;" src ="avatar.php?id=<?php echo $post['userId']; ?>"> -->
          <!-- <img style="width: 150px;"src="./avatars/<?php echo $post['userId']; ?>.jpg"> -->
          <?php else : ?>
          <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
          <!-- <img style="width: 150px;"src="no-avatar.jpg"> -->
          <?php endif; ?>
        <!-- <div class="col-sm"> -->
        <?php echo $post['displayName']; ?>
        </h4>
        <!-- </div>
        </div>
        </div>
        </h4> -->
        <p class="card-text">
        <small>Đăng lúc: <?php echo $post['createdAt'] ?></small>
        <label style ='font-size:10px'>(<?php echo $post['privacy'].')'; ?></label>
        <p style ='font-size:18px'><?php echo $post['content'] ?></p>
        <?php if($post['image']): ?>
        <img src ="imagePost.php?id=<?php echo $post['id']; ?>"  alt="Cinque Terre" >
        <?php endif;?>
        </p>
        

        <?php
      $countlike=DemLike($post['id']);
      $countcommemnt=getcountcomments($post['id']);
    ?>
    <div class="card-body">
    <hr>
        <div class="row">
            
            <div class="btn-group" style="position: relative;bottom:6px;left:23px">
            <?php if (KiemTraLike($post['id'],$currentUser['id'])): ?>
            <a class="btn"name="unlike"id="unlike"href="likeCaNhan.php?type=unlike&id=<?php echo $post['id'] ?>"style='color:blue'><i style='font-size:20px' class='far fa-thumbs-up'data-toggle="tooltip" title="Cảm xúc của bạn với status này!!"></i> Thích  <span class="badge badge-primary  rounded-circle" ><?php echo implode(" ",$countlike);?></span></a>
            <?php else:?>
            <a class="btn"name="like"id="like"href="likeCaNhan.php?type=like&id=<?php echo $post['id'] ?>"style='color:black'><i style='font-size:20px' class='far fa-thumbs-up'data-toggle="tooltip" title="Cảm xúc của bạn với status này!!"></i> Thích  <span class="badge badge-light  rounded-circle"><?php echo implode(" ",$countlike);?></span></a>
            <?php endif ?>
            </div>&emsp;&emsp;
            
            <div>
            <h9 aria-haspopup="true" aria-expanded="false"><i style='font-size:20px' class='far fa-comment-alt'data-toggle="tooltip" title="Cảm nghĩ của bạn về bài viết này!"></i> Bình luận<span class="badge badge-light  rounded-circle"><?php echo implode(" ",$countcommemnt);?></span></h9>
            </div>&emsp;&emsp;
            <div>
                <h9 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style="font-size:20px" class="fa fa-share" data-toggle="tooltip" title="Chia sẻ với bạn bè" aria-hidden="true"></i><span class="sr-only">Chia sẻ với bạn bè</span> Chia sẻ </h9>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Chia sẻ ngay (Công khai)</a>
                    <a class="dropdown-item" href="#">Chia sẻ ...</a>
                    <a class="dropdown-item" href="#">Gửi dưới dạng tin nhắn</a>
                    <a class="dropdown-item" href="#">Chia sẻ trên dòng thời gian với bạn bè</a>
                    <a class="dropdown-item" href="#">Chia sẻ lên trang</a>
                </div>
            </div>
        </div>
    <hr>
    <?php $getcomment=getcomment($post['id']);
    ?>
    <?php if(usercommentd($post['id'],$currentUser['id'])): ?>
    <div class="target" style="height:200px;overflow:scroll;" >
        <?php foreach ($getcomment as $postss):?>
            
        <div class="card" >
        <div class="card-body">
                <h5 class="card-title">
                    <?php if($postss['avatar']):?> 
                      <img src ="avatar.php?id=<?php echo $postss['userId']; ?>" class="img-circle" alt="Cinque Terre" width="35" height="35">  
                    <?php else: ?>
                    <img src="no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="35" height="35">
                    <?php endif ?> 
                    <a href="profile.php?id=<?php echo $postss['userId'] ?>"><div style="position: absolute; left:80px;top:20px " ><?php echo $postss['displayName']?> </div> </a>          
                  </h5> 

                  <small><p class="card-text"style="position: absolute; left:80px;top:50px" > Bình luận lúc: 
                    <?php echo $postss['createdAt'];?>
                </p></small>
                <p >
                    <?php echo $postss['content'];?>
                </p>
                <div class="col"style="text-align: right;position: absolute; left:8px;top:8px ">
                <form method="post">
                <button  type="submit" name="deletecomment" value = <?php echo $postss['id']; ?>  class="btn btn-danger" >Xóa</button>   
                </form>

                <?php 
                if(isset($_POST['deletecomment']))
                {
                    $value_commnet=$_POST['deletecomment'];
                    
                    deletecomment($value_commnet);
                    header("Location: index.php");
                    }
                ?>
                  
            </div>  
            </div>  
            </div>
        <?php endforeach ?>
                        </div>
    <?php else:?>
            <div></div>
    <?php endif?>
    <form action="upcomment1.php?type=upcommentindex&id=<?php echo $post['id'] ?>" method="POST" >
    <div class="form-group">
        <textarea style="height:50px" class="form-control" name="contents" id="contents" rows="3"placeholder="Thêm bình luận..."></textarea>                                
    </div>        
    <button type="submit" class="btn btn-primary" name="upcomment">comment</button>
    </form>	
</div>


      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>