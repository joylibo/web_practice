<?php

namespace DBpro\Model;

require_once('DBUtils.interface.php');

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


  /**
  *isEmailExits方法接受一个字符串参数$newEmail,返回当前用户信息表中是否有用户已经注册了这个email，
  *如果已经有人注册，返回true，否则返回false
  */
  public function isEmailExits($newEmail)
  {
    $mysqli = @new \mysqli(self::DBhost.':'.self::DBport,self::DBusername,self::DBpasswd,self::DBschema);

    if ($mysqli->connect_errno) {
        printf("连接失败: %s\n", $db->connect_error);
        exit();
    }

    $probe = false;
    $sql = "SELECT * FROM users_t WHERE email = ?";

    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('s',$newEmail);

    $mysqli_stmt->execute();

    $mysqli_stmt->store_result();

    if (0 < $mysqli_stmt->num_rows) {
      $probe = true;
    }
    $mysqli_stmt->close();
    $mysqli->close();
    return $probe;
  }
  /**
  *register方法接受一个数组参数$regArray,将数组存储到用户信息表中
  *如果写入存储成功，返回true，否则返回false
  */
  public function register($username,$email,$psw)
  {
    $mysqli = @new \mysqli(self::DBhost.':'.self::DBport,self::DBusername,self::DBpasswd,self::DBschema);

    if ($mysqli->connect_errno) {
        printf("连接失败: %s\n", $db->connect_error);
        exit();
    }

    $probe = false;
    $sql = "INSERT INTO users_t (username, email, psw, last_update) VALUES (?,?,PASSWORD(?),NOW())";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('sss',$username,$email,$psw);
    $mysqli_stmt->execute();
    if (1 == $mysqli_stmt->affected_rows) {
      $probe = true;
    }
    $mysqli_stmt->close();
    $mysqli->close();
    return $probe;
  }
}
