<?php
namespace DBpro\Controller;

use DBpro\Model\DBUtils;

require_once('Model/DBUtils.class.php');
require_once('Handle.class.php');
/**
 *
 */
class RegisterHandle extends Handle
{
  public function doRegister()
  {
    //从POST数组中取用户填写的信息
    $username = $this->safe_post('username');
    $email = $this->safe_post('email');
    $psw1 = $this->safe_post('psw1');
    $psw2 = $this->safe_post('psw2');


    //检测两次密码是否相同
    if ($psw1 != $psw2) {
      $return_arr = ['code'=>Handle::PSW_NOT_EQUAE,'msg'=>'两次输入密码不同'];
      return json_encode($return_arr);
    }


    $DBUtils = new DBUtils();

    if ($DBUtils->isEmailExits($email)) {
      //isEmailExits()返回true说明此邮箱已经存在
      $return_arr = ['code'=>Handle::REGI_EMAIL_EXISTS,'msg'=>'email已经存在'];
      return json_encode($return_arr);
    }

    //执行到这里，说明email没有被注册过，则将用户数据，写入database
    if ($DBUtils->register($username,$email,$psw1)) {
      $return_arr = ['code'=>Handle::SECCESS_RETURN,'msg'=>'注册成功'];
      return json_encode($return_arr);
    }else {
      $return_arr = ['code'=> Handle::CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息'];
      return json_encode($return_arr);
    }
  }
}
