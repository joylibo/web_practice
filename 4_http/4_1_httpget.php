<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>http get方法传值</title>
  </head>
  <body>
    <?php
    /*通过下面地址
    http://127.0.0.1/web_practice/4_http/4_1_httpget.php?nameid=1
    来访问本页面(根据你自己的DocumentRoot地址改变访问路径)。
    url中nameid的值可以不断改变，在浏览器中观察返回值
    */
    $nameid = isset($_GET['nameid'])?$_GET['nameid']:null;
    //$nameid = $_GET['nameid'];
    switch ($nameid) {
      case '1':
        echo "1.哈利波特";
        break;
      case '2':
        echo "2.指环王";
        break;
      case '3':
        echo "3.霍比特人";
        break;
      default:
        echo "没有你要找的东西";
        break;
    }
    $name = $_GET['name'];
    echo $name;
     ?>
  </body>
</html>
