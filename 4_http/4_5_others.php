<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>其他http信息</title>
  </head>
  <body>
    <h1>提交表单，观察变量</h1>
    <form enctype="multipart/form-data" action="./4_5_others.php?isfine=true" method="post">
      <input type="text" name="textinput" value="">
      <br/>
      <input type="radio" name="sex" value="male" checked>男
      <input type="radio" name="sex" value="female">女
      <br/>
      <input type="checkbox" name="vehicle" value="mobike">mobike
      <input type="checkbox" name="vehicle" value="ofo">ofo
      <br/>
      <input type="file" name="myfile" value="">
      <br/>
      <input type="submit" name="" value="提交">
    </form>
  <?php
  //由于session、cookie、post、get四个超全局变量已经介绍过，本节就不再展示.
  //另外，GLOBALS变量是一个特殊的超全局变量，本节暂不涉猎。
  echo "<h2>其他超全局变量</h2>";
  echo "<h4>_SERVER变量</h4>";
  //print_r($_SERVER);
  echo get_detail($_SERVER);
  echo "<h4>_REQUEST变量</h4>";
  print_r($_REQUEST);
  //echo get_detail($_REQUEST);
  echo "<h4>_FILES变量</h4>";
  print_r($_FILES);
  //echo get_detail($_FILES);
  echo "<h4>_ENV变量</h4>";
  print_r($_ENV);
  //echo get_detail($_ENV);
  echo "<br/>_ENV数组服务器操作系统信息，一般情况下，根据php.ini的默认设置，无法获取服务器操作系统信息，此时_ENV变量为空，这是基于安全考虑，如果有需要，可通过修改php.ini来重新获取";


  function get_detail($data){
    $msg = '[';
    foreach ($data as $key => $value) {
      $msg .= '"'.$key.'"=>"'.$value.'",<br/>';
    }
    # 把最后的一个逗号去掉
    $msg = chop($msg,',<br/>');
    $msg .= ']';


    return $msg;
  }
   ?>
  </body>
</html>
