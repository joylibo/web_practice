<?php

namespace DBpro\Model;

require_once('./DBUtils.class.php');

/**
 *
 */
class DBUtils implements iDBUtils
{
  const DBhost = '55a32a9887e03.gz.cdb.myqcloud.com';
  const DBport = '16273';
  const DBusername = 'cdb_outerroot';
  const DBpasswd = 'Libo1234';
  const DBschema = 'web_practice';

  @$db = new mysqli(DBhost.':'.DBport,DBusername,DBpasswd,DBschema);

  if ($db->connect_errno) {
      printf("连接失败: %s\n", $db->connect_error);
      exit();
  }

  /**
  *isEmailExits方法接受一个字符串参数$newEmail,返回当前用户信息表中是否有用户已经注册了这个email，
  *如果已经有人注册，返回true，否则返回false
  */
  public function isEmailExits($newEmail)
  {
    $probe = false;
    if ($result = $db->query("SELECT * FROM users_t WHERE email = $newEmail")) {
        if($result->num_rows > 0){
            $probe = true;
        }
        /* 关闭 result */
        $result->close();
    }

    $db->close();
    return $probe;
  }
  /**
  *register方法接受一个数组参数$regArray,将数组存储到用户信息表中
  *如果写入存储成功，返回true，否则返回false
  */
  public function register($regArray)
  {

  }
}
