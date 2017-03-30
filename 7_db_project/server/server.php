<?php
session_start();

use DBpro\Controller\LoginHandle;
use DBpro\Controller\RegisterHandle;

require_once('Controller/RegisterHandle.class.php');

const ILLEGAL_ACT_VALUE = 1;

# 从url里面取act值，根据不同的值来判断应该用何种方法来处理用户数据
$act = isset($_GET['act'])?$_GET['act']:null;
switch ($act) {
  case 'login':
    //编写LoginHandle类去处理。
    $lh = new LoginHandle();
    //echo $lh->doLogin();
    break;
  case 'register':
    $rh = new RegisterHandle();
    echo $rh->doRegister();
    break;
  default:
    $return_arr = ['code'=>ILLEGAL_ACT_VALUE,'msg'=>'请传入正确的act值'];
    echo json_encode($return_arr);
    break;
}
