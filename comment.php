<?php 
require_once 'init.php';
if (!$currentUser){
    header ('Location: index.php');
    exit();
}

$comment=$_POST['comment'];
$post=$_POST['postId'];
Createcomments($currentUser['id'],$post,$comment);





header('Location: index.php');