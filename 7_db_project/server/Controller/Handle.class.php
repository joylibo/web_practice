<?php
namespace Filepro\Controller;

/**
 * Handle类的基类，
 */
class Handle
{
  function __construct()
  {
    # code...
  }
  const SECCESS_RETURN = 1000;
  const ILLEGAL_ACT_VALUE = 1;
  const PSW_NOT_EQUAE = 2;
  const CAN_NOT_STORE = 3;
  const REGI_EMAIL_EXISTS = 4;

  const USER_STATUS_NORMAL = 1;
  /**
   *封装$_POST与$_GET数组，避免数组未赋值的情况下php解释器报错
   */
  public function safe_get($name_str)
  {
    return isset($_GET[$name_str])?$_GET[$name_str]:null;
  }

  public function safe_post($name_str)
  {
    return isset($_POST[$name_str])?$_POST[$name_str]:null;
  }
}
