<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登录</title>
  </head>
  <body>
    <form class="" action="server.php?act=login" method="post">
      <input type="email" name="email" value="" placeholder="请输入邮箱"><br/>
      <input type="password" name="psw" value="" placeholder="请输入密码"><br/>
      <input type="submit" name="submitbtn" value="提交">
      <br>
      <a href="./register.html">新用户注册</a>
    </form>
    <br/>
    <br/>
    <br/>
    <p>注：一个健壮而完备的项目中，应该提供找回密码功能，通常有三种方式来实现：</p>
    <ol>
      <li>短信</li>
      <li>邮箱</li>
      <li>密码保护问题</li>
    </ol>
    <p>另外，为安全考虑，项目中还需要加入图形或语音验证码来防止暴力破解。<br/>
      本项目作为一个学习入门学习类项目，暂不提供上述功能，如果需要了解，请关注后续进阶教程</p>
  </body>
</html>
