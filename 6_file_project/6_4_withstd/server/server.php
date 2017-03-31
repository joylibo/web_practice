<?php
session_start();

use Controller\LoginHandle;
use Controller\RegisterHandle;

require_once('./function.php');

# 从url里面取act值，根据不同的值来判断应该用何种方法来处理用户数据
$act = safe_get('act');
switch ($act) {
  case 'login':
    echo loginHandle();
    Loginhandle
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
    提示1：用户的登录状态可以考虑用session或者cookie的机制来做；
    提示2(重要)：“退出登录”按钮使用ajax技术来实现时候不需要使用隐藏表单
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
      return json_encode($return_arr);
    }
    //检测注册的email是否存在
    if (file_exists('./data/userinf') && email_exists($email)) {
      $return_arr = ['code'=>REGI_EMAIL_EXISTS,'msg'=>'email已经存在'];
      return json_encode($return_arr);
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
      $fp = @fopen("./data/userinf",'a');
      if (!$fp) {
        $return_arr = ['code'=> CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息'];
        return json_encode($return_arr);
      }
      fwrite($fp,json_encode($reg_array)."\r\n");
      fclose($fp);
      $return_arr = ['code'=>SECCESS_RETURN,'msg'=>'注册成功'];
      return json_encode($return_arr);
    } catch (Exception $e) {
      $return_arr = ['code'=> CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息，错误信息:'.$e->getMessage()];
      return json_encode($return_arr);
    }
  }



 ?>
