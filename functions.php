<?php
require_once('./vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function detectPage(){
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $uri);
    $fileName = $parts[2];
    $parts = explode('.',$fileName);
    $page = $parts[0];
    return $page;
}

function findUserByEmail($email){
    global $db;
    $stmt =$db->prepare("SELECT *FROM users WHERE email= ?");
    $stmt->execute(array($email));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserById($id){
    global $db;
    $stmt =$db->prepare("SELECT *FROM users WHERE id= ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function UpdateUserPassword($id, $password){
    global $db;
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);
    $stmt=$db->prepare("UPDATE users SET password= ? WHERE id= ?");
    return $stmt->execute(array($hashPassword,$id));
}

function createUser($displayName,$email,$password,$gender,$phone){
    global $db, $BASE_URL;
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);
    $code=generateRandomString(16);
    $stmt=$db->prepare("INSERT INTO users (displayName,email,password, gender, phone,status,code) VALUES (? , ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($displayName, $email, $hashPassword,$gender, $phone,0, $code));
    $id = $db->lastInsertId();
    sendEmail($email,$displayName,'Kích hoạt tài khoản',"Mã kích hoạt tài khoản của bạn la <a href =\"$BASE_URL/activate.php?code=$code\">$BASE_URL/activate.php?code=$code</a>");
    return $id;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($to,$name, $subject, $content){

    global $EMAIL_FROM, $EMAIL_NAME, $EMAIL_PASSWORD;
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet    = 'UTF-8';
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $EMAIL_FROM ;                     // SMTP username
    $mail->Password   = $EMAIL_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($EMAIL_FROM , $EMAIL_NAME );
    $mail->addAddress($to, $name);     // Add a recipient
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    //$mail->AltBody = $content;

    $mail->send();
} 

function activateUser($code) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE code = ? AND status = ?");
    $stmt->execute(array($code, 0));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['code'] == $code) {
      $stmt = $db->prepare("UPDATE users SET code = ?, status = ? WHERE id = ?");
      $stmt->execute(array('', 1, $user['id']));
      return true;
    }
    return false;
}
function updateUser($user) {
  global $db;
  $stmt = $db->prepare("UPDATE users SET displayName = ?, phone = ?, hasAvatar = ? WHERE id = ?");
  $stmt->execute(array($user['displayName'], $user['phone'], $user['hasAvatar'], $user['id']));
  return $user;
}
function createPost($userId, $content) {
  global $db;
  $stmt = $db->prepare("INSERT INTO posts (userId, content, createdAt) VALUE (?, ?, CURRENT_TIMESTAMP())");
  $stmt->execute(array($userId, $content));
  return $db->lastInsertId();
}
function getNewFeeds() {
  global $db;
  $stmt = $db->prepare("SELECT p.id, p.userId, u.displayName as userdisplayName, u.hasAvatar as userHasAvatar, p.content, p.createdAt FROM posts as p LEFT JOIN users as u ON u.id = p.userId ORDER BY createdAt DESC");
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}


function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
    $width = ($max_height / $height) * $width;
    $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
    $height = ($max_width / $width) * $height;
    $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}
