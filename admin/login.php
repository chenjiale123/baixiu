<?php
require_once "../config.php";
session_start();

function login(){
  if(empty($_POST["email"])){
    $GLOBALS["message"]="请填写邮箱" ;
    return ;
  }
  if(empty($_POST["password"])){
    $GLOBALS["message"]="请填写密码";
    return;
  }
  $email=$_POST["email"];
  $password=$_POST["password"];
  // if($email !== "admin@zce.me"){
  //   $GLOBALS["message"]="邮箱密码不匹配" ;
  //   return ;
  // }
  // if($password!=="wanglei"){
  //   $GLOBALS["message"]="邮箱密码不匹配" ;
  //   return ;
  // }
  $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  if(!$conn){
    exit("<h1>连接失败</h1>");
  }


  $query=mysqli_query($conn,"select * from users where email='{$email}' limit 1;" );
  if(!$query){
    $GLOBALS["message"]="登陆失败请重试";
  }

  $user=mysqli_fetch_assoc($query);
 if(!$user){
    $GLOBALS["message"]="邮箱密码不匹配" ;
    return ;
  }
  if($user["password"]!==$password){
    $GLOBALS["message"]="邮箱密码不匹配" ;
    return ;
  }

$_SESSION["current_login_user"]=$user;


header('location:/baixiu/admin');
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  login();
}


?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/baixiu/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/baixiu/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <img class="avatar" src="/baixiu/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if(isset($message)) : ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php  echo  $message ;?>
      </div>
      <?php endif  ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email"type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block" href="index.php">登 录</button>
    </form>
  </div>

  <script src="/baixiu/assets/vendors/jquery/jquery.js"></script>
  <script>
  $(function ($) {
    $("#email").on("blur",function(){
    

    var value=$(this).val();
    $.get('/baixiu/admin/api/avatar.php',{email:value},function(res){
  if(!res)  return;

  $(".avatar").attr("src",res);




    })


    })

  })
  
  
  </script>
</body>
</html>
