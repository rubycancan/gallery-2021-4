<?php
//表单进行了提交处理
if (isset($_POST['submit'])) {
    include './lib/fun.php';

    //连接数据库
    $mysqli = @new mysqli('localhost', 'root', 'root', 'gallery');
    if ($mysqli->connect_error) {
        message(2, $mysqli->connect_error.' ，请重试');
    }
    $mysqli->query('set names utf8');
    //对表单数据进行处理
    $username = $mysqli->escape_string(trim($_POST['username']));
    $password = $mysqli->escape_string(trim($_POST['password']));
    $repassword = $mysqli->escape_string(trim($_POST['repassword']));
    $admin = 0;

    if (! $username) {
        message(2, '用户名不能为空');
    }

    if (! $password) {
        message(2, '密码不能为空');
    }

    if (! $repassword) {
        message(2, '确认密码不能为空');
    }

    if ($password !== $repassword) {
        message(2, '两次输入密码不一致，请重新输入');
    }

    //验证用户名是否已存在
    $sql = "SELECT COUNT(`username`) AS `total` FROM `users` WHERE `username` = '{$username}'";
    $result = $mysqli->query($sql);
    if (! $result) {
        message(2, $mysqli->error.' ，请重试');
    }
    $data = $result->fetch_array(MYSQLI_ASSOC);
    if(isset($data['total']) && $data['total'] > 0) {
        message(2, '用户名已存在，请重新输入');
    }

    //密码加密和时间戳
    $password = md5($password);
    $create_time = $_SERVER['REQUEST_TIME'];

    //插入数据
    $sql = "INSERT INTO `users`(`username`,`password`,`create_time`) VALUES('{$username}','{$password}','{$create_time}')";
    $result = $mysqli->query($sql);
    //数据库插入成功返回true,插入失败返回false
    if ($result) {
      message(1,'注册成功','login.php');
    } else {
      message(2,$mysqli->error.' ，请重试');
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<title>用户注册</title>
	<link href="./static/css/common.css" type="text/css" rel="stylesheet">
  <link href="./static/css/add.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="./static/css/login.css">
</head>
<body>
  <div class="header">
   <div class="logo f1">
    <img src="./static/image/logo.png">
  </div>
  <div class="auth fr">
    <ul>
     <li><a href="login.php">登录</a></li>
     <li><a href="register.php">注册</a></li>
   </ul>
 </div>
</div>
<div class="content">
  <div class="center">
    <div class="center-login">
      <div class="login-banner">
       <a href="#"><img src="./static/image/login_banner.png" alt=""></a>
     </div>
     <div class="user-login">
       <div class="user-box">
         <div class="user-title">
           <p>用户注册</p>
         </div>
         <form class="login-table" name="register" id="register-form" action="register.php" method="post">
          <div class="login-left">
            <label class="username">用户名</label>
            <input type="text" class="yhmiput" id="username" name="username" value="" autocomplete="off">
          </div>
          <div class="login-right">
            <label class="passwd">密码</label>
            <input type="password" class="yhmiput" id="password" name="password">
          </div>
          <div class="login-right">
            <label class="passwd">确认</label>
            <input type="password" class="yhmiput" id="repassword" name="repassword">
          </div>
            <div class="login-btn"><button type="submit" name='submit' value='submit'>注册</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="footer">
 <p><span>M-GALLARY</span> ©2017 POWERED BY IMOOC.INC</p>
</div>
</body>
<script src="./static/js/jquery-1.10.2.min.js" charset="utf-8"></script>
<script src="./static/js/layer-v3.3.0/layer/layer.js" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
      $('#register-form').submit(function() {
        var username = $('#username').val(),
            password = $('#password').val(),
            repassword = $('#repassword').val();
        if (username == '' || username == null) {
          layer.tips('用户名不能为空！', '#username');
          $('#username').focus();
          return false;
        }

        if (password == '' || password == null) {
          layer.tips('密码不能为空！', '#password');
          $('#password').focus();
          return false;
        }

        if (repassword == '' || repassword == null || repassword != password) {
          layer.tips('两次密码输入不一致！', '#repassword');
          return false;
        }
        return true;
      });

});
</script>
</html>
