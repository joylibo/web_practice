<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>注册新用户</title>
  </head>
  <body>
    <h3>注册新用户</h3>
    <form class="" action="server.php?act=register" method="post">
      <input type="text" name="username" value="" placeholder="请输入你的真实姓名"><br/>
      <input type="email" name="email" value="" placeholder="请输入邮箱"><br/>
      <input type="password" name="psw1" value="" placeholder="请输入密码"><br/>
      <input type="password" name="psw2" value="" placeholder="请再次输入密码"><br/>
      <input type="submit" name="" value="提交">
    </form>
    <?php
    $getcode = isset($_GET['code'])?$_GET['code']:null;
    $getmsg = isset($_GET['msg'])?$_GET['msg']:null;
    $sscode = isset($_SESSION['code'])?$_SESSION['code']:null;
    $ssmsg = isset($_SESSION['msg'])?$_SESSION['msg']:null;
    $ckcode = isset($_COOKIE['code'])?$_COOKIE['code']:null;
    $ckmsg = isset($_COOKIE['msg'])?$_COOKIE['msg']:null;
    if (null != $getcode) {
      echo '<p style="color:red">'.$getmsg.'</p>';
    }
    if (null != $sscode) {
      echo '<p style="color:red">'.$ssmsg.'</p>';
      $_SESSION['code'] = null;
      $_SESSION['msg'] = null;
    }
    if (null != $ckcode) {
      echo '<p style="color:red">'.$ckmsg.'</p>';
    }

     ?>
  </body>
</html>
