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

    $DBUtils = new DBUtils();

    //检测两次密码是否相同
    if ($psw1 != $psw2) {
      $return_arr = ['code'=>Handle::PSW_NOT_EQUAE,'msg'=>'两次输入密码不同'];
      return json_encode($return_arr);
    }


    if ($fileUtils->isEmailExits($email)) {
      //isEmailExits()返回true说明改邮箱已经存在
      $return_arr = ['code'=>Handle::REGI_EMAIL_EXISTS,'msg'=>'email已经存在'];
      return json_encode($return_arr);
    }

    $reg_array = ['userid'=>$DBUtils->getNextId(),
                  'username'=>$username,
                  'email'=>$email,
                  'psw'=>$psw1,
                  'status'=>Handle::USER_STATUS_NORMAL,
                  'create_date'=>time()];

    if ($DBUtils->register($reg_array)) {
      $return_arr = ['code'=>Handle::SECCESS_RETURN,'msg'=>'注册成功'];
      return json_encode($return_arr);
    }else {
      $return_arr = ['code'=> Handle::CAN_NOT_STORE,'msg'=>'服务器不能存储您的注册信息'];
      return json_encode($return_arr);
    }
  }
}
