<?php
require './lib/fun.php';

if (checkLogin()) {
  message(1, '您已登录，将跳转至首页', 'index.php');
}

//表单进行了提交处理
if (isset($_POST['submit'])) {
    //连接数据库
    $mysqli = @new mysqli('localhost', 'root', 'root', 'gallery');
    if ($mysqli->connect_error) {
        message(2, $mysqli->connect_error.' ，请重试');
    }
    $mysqli->query('set names utf8');

    //表单数据处理
    $username = $mysqli->escape_string(trim($_POST['username']));
    $password = trim($_POST['password']);
    //表单提交数据不能为空
    if (! $username) {
        message(2, '用户名不能为空');
    }

    if (! $password) {
        message(2, '用户密码不能为空');
    }

    //根据用户名从数据库查询用户
    $sql = "SELECT * FROM `users` WHERE `username`='{$username}' LIMIT 1";
    $result = $mysqli->query($sql);
    $data = $result->fetch_array(MYSQLI_ASSOC);
    //result返回一个mysqli_result对象，data当用户存在时返回用户信息数组，用户不存在时返回NULL
    if(is_array($data) && !empty($data)) {
        if(md5($password) === $data['password']) {
            $_SESSION['user'] = $data;
            header('Location:index.php');
            exit;
        } else {
            message(2, '密码不正确，请重新登录');
        }
    } else {
        message(2, '用户不存在，请重新登录');
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<title>用户登录</title>
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
           <p>用户登录</p>
         </div>
         <form class="login-table" name="login" id="login-form" action="login.php" method="post">
          <div class="login-left">
            <label class="username">用户名</label>
            <input type="text" class="yhmiput" id="username" name="username" value="" autocomplete="off">
          </div>
          <div class="login-right">
            <label class="passwd">密码</label>
            <input type="password" class="yhmiput" id="password" name="password">
          </div>
            <div class="login-btn"><button type="submit" name='submit' value='submit'>登录</button></div>
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
    $("#login-form").submit(function() {
        var username = $("#username").val(),
            password = $("#password").val();
        if (username == '' || username == null) {
            layer.tips('用户名不能为空', '#username');
            $("#username").focus();
            return false;
        }
        if (password == '' || password == null) {
            layer.tips('用户密码不能为空', '#password');
            $("#password").focus();
            return false;
        }
        return true;
    });
});
</script>
</html>
