<?php session_start(); //注意session_start()必须在<html>标签之前进行调用
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>session的设置</title>
  </head>
  <body>
    <?php
        $session = isset($_SESSION['name'])?$_SESSION['name']:null;
        function showCookie($session){
          if (null == $session) {
            $msg = '现在没有session，但是我们可以写入session。刷新一次再看看吧！<br/>
            （当你看到这段文字的时候，几乎同时，服务器已经写了一个session键值对在服务器的内存之中了）';
            //保存session值
            $_SESSION['name']="五邑大学";
            return $msg;
          }else {
            $msg = '["';
            foreach ($_SESSION as $key => $value) {
              $msg .=  $key.'"=>"'.$value.'"';
            };
            $msg .= ']';
            return '你要取的那个保存在session里面的值是:'.$session.
            '<br/><br/>当前session中保存的全部数据是:<br/>'.$msg.
            '<br/><br/>session的过期时间是在web服务器的配置文件中设置的，一般默认发呆时间
            超过30分钟则失效。如果你想回到没有session的页面，可以关掉网页30分钟之后再进来，
            或者立即换个浏览器进行访问';
          }
        }
        echo showCookie($session);
     ?>
  </body>
</html>
