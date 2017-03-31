<?php
define('SECCESS_RETURN',1000);
define('ILLEGAL_ACT_VALUE',1);
define('PSW_NOT_EQUAE',2);
define('CAN_NOT_STORE',3);
define('REGI_EMAIL_EXISTS',4);

define('USER_STATUS_NORMAL',1);

/**
 *封装$_POST与$_GET数组，避免数组未赋值的情况下php解释器报错
 */
function safe_get($name_str)
{
  return isset($_GET[$name_str])?$_GET[$name_str]:null;
}

function safe_post($name_str)
{
  return isset($_POST[$name_str])?$_POST[$name_str]:null;
}

function email_exists($email_str)
{
  # 查看一个email地址是不是已经存在
  $probe = false;
  $fp = fopen("../data/userinf",'rb');
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

function get_next_id()
{
  # 获取下一行插入的数据应该是什么ID
  $id = 0;
  $fp = @fopen("../data/userinf",'r');
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
