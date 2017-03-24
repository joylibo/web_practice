<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cookie的设置</title>
  </head>
  <body>
<?php
    $cookie = isset($_COOKIE['name'])?$_COOKIE['name']:null;
    function showCookie($cookie){
      if (null == $cookie) {
        $msg = '现在没有cookie，但是我们可以写入cookie。刷新一次再看看吧！<br/>
        （当服务器把当前你正在阅读的这个页面发给你的浏览器的时候，已经通知了浏览器要把一个叫name
        的属性写进cookie里，所以你现在阅读这段文字的时候，cookie已经在你的浏览器之中了）';
        setcookie("name","福招", time()+100);
        return $msg;
      }else {
        $msg = '["';
        foreach ($_COOKIE as $key => $value) {
          $msg .=  $key.'"=>"'.$value.'"';
        };
        $msg .= ']';
        return '你要取的那个保存在cookie里面的值是:'.$cookie.'<br/><br/>当前cookie中保存的全部数据是（100秒后失效）:<br/>'.$msg;
      }
    }
    echo showCookie($cookie);
 ?>
  </body>
</html>
