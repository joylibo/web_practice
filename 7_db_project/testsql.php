<?php
const DBhost = '55a32a9887e03.gz.cdb.myqcloud.com';
const DBport = '16273';
const DBusername = 'cdb_outerroot';
const DBpasswd = 'Libo1234';
const DBschema = 'web_practice';

$db = new mysqli(DBhost.':'.DBport,DBusername,DBpasswd,DBschema);


/* check connection */
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

/**
*isEmailExits方法接受一个字符串参数$newEmail,返回当前用户信息表中是否有用户已经注册了这个email，
*如果已经有人注册，返回true，否则返回false
*/

  if ($result = $db->query("SELECT email FROM users_t ")) {
      printf("Select returned %d rows.\n", $result->num_rows);

      /* free result set */
      $result->close();
  }

  $db->close();
