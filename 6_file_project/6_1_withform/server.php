<?php
session_start();
define('SECCESS_RETURN',1000);
define('ILLEGAL_ACT_VALUE',1);
define('PSW_NOT_EQUAE',2);
define('CAN_NOT_STORE',3);
define('REGI_EMAIL_EXISTS',4);

define('USER_STATUS_NORMAL',1);

/**
 *封装$_POST与$_GET数组，避免数组未赋值的情况下php解释器报错
 */
function safe_get($name_str){
  return isset($_GET[$name_str])?$_GET[$name_str]:null;
}
function safe_post($name_str){
  return isset($_POST[$name_str])?$_POST[$name_str]:null;
}

# 从url里面取act值，根据不同的值来判断应该用何种方法来处理用户数据
$act = safe_get('act');
switch ($act) {
  case 'login':
    echo loginHandle();
    break;
  case 'register':
    echo registerHandle();
    break;
  default:
    $return_arr = ['code'=>ILLEGAL_ACT_VALUE,'msg'=>'请传入正确的act值'];
    echo json_encode($return_arr);
    break;
}

  function loginHandel(){
    # 用户登录处理主函数
    $email = safe_post('email');
    $psw = safe_post('psw');
    /*
    登录部分，请自己完成，要求：
    1.用户填写email和密码登录
    2.登录失败时候重新回到登录页，在页面中显示登录失败的原因
    3.登录成功时跳转到hello.php，在hello.php中显示用户的个人信息
    4.用户没有登录的情况下，不能直接按照url访问hello.php，如果用户尝试访问，则自动跳转到index.php并提示用户需要先登录
    5.在hello.php中制作一个“退出登录”的按钮，点击按钮回到没有登录的状态(没有登录的状态意味着不能再访问hello.php)
    提示：用户的登录状态可以考虑用session或者cookie的机制来做；“退出登录”按钮，可以考虑用隐藏表单来实现
    */

  }


  function registerHandle(){
    # 用户注册处理主函数

    //从POST数组中取用户填写的信息
    $username = safe_post('username');
    $email = safe_post('email');
    $psw1 = safe_post('psw1');
    $psw2 = safe_post('psw2');
    //检测两次密码是否相同
    if ($psw1 != $psw2) {
      $return_arr = ['code'=>PSW_NOT_EQUAE,'msg'=>'两次输入密码不同'];
      header('Location: http://127.0.0.1/web_practice/6_file_project/6_1_withform/register.php?act=register&code='
      .$return_arr['code'].'&msg='.$return_arr['msg']);
      exit();
    }
    //检测注册的email是否存在
    if (file_exists('./data/userinf') && email_exists($email)) {
      $return_arr = ['code'=>REGI_EMAIL_EXISTS,'msg'=>'email已经存在'];
      $_SESSION['code'] = $return_arr['code'];
      $_SESSION['msg'] = $return_arr['msg'];
      header('Location: http://127.0.0.1/web_practice/6_file_project/6_1_withform/register.php?act=register');
      exit();
    }
    //拼装需要存储的数组
    $reg_array = ['userid'=>get_next_id(),
                  'username'=>$username,
                  'email'=>$email,
                  'psw'=>$psw1,
                  'status'=>USER_STATUS_NORMAL,
                  'create_date'=>time()];
    //向本地文件中写入用户注册信息
    try {
      $fp = fopen("./data/userinf",'a');
      if (!$fp) {
        $return_arr = ['code'=> CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息'];
        return json_encode($return_arr);
      }
      fwrite($fp,json_encode($reg_array)."\r\n");
      fclose($fp);
      $return_arr = ['code'=>SECCESS_RETURN,'msg'=>'注册成功'];
    } catch (Exception $e) {
      $return_arr = ['code'=> CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息，错误信息:'.$e->getMessage()];
      $_COOKIE['code'] = $return_arr['code'];
      $_COOKIE['msg'] = $return_arr['msg'];
      header('Location: http://127.0.0.1/web_practice/6_file_project/6_1_withform/register.php?act=register');
      exit();
    }
  }

  function email_exists($email_str){
    # 查看一个email地址是不是已经存在
    $probe = false;
    $fp = fopen("./data/userinf",'rb');
    while (!(feof($fp)||$probe)) {
      $user_arr = json_decode(fgets($fp));
      if (!isset($user_arr->email)) {
        break;
      }
      if($email_str == $user_arr->email){
          $probe = true;
      }
    }
    fclose($fp);
    return $probe;
  }
  function get_next_id(){
    # 获取下一行插入的数据应该是什么ID
    $id = 0;
    $fp = @fopen("./data/userinf",'r');
    if (!$fp) {
      return $id;
    }
    while (!feof($fp)) {
      $cont = fgets($fp);
      $id++;
    }
    fclose($fp);
    return $id;
  }

 ?>
