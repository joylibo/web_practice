<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>http post方法传值</title>
  </head>
  <body>
    <?php
    $post_para = isset($_POST['para'])?$_POST['para']:null;
    $form ='<form class="" action="./4_2_httppost.php" method="post">
                <input type="text" name="para" value="">
                <input type="submit" value="提交">
              </form>';

    function show($post_para,$form){
      if (null == $post_para) {
        return $form;
      }else {
        return '我收到了你传来的值是'.$post_para;
      }
    };
    echo show($post_para,$form);
    ?>
  </body>
</html>
