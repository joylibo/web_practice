<?php
namespace Model;

interface iFileUtils
{
  /**
  *isEmailExits方法接受一个字符串参数$newEmail,返回当前用户信息表中是否有用户已经注册了这个email，
  *如果已经有人注册，返回true，否则返回false
  */
  public function isEmailExits($newEmail);
  /**
  *register方法接受一个数组参数$regArray,将数组存储到用户信息表中
  *如果写入存储成功，返回true，否则返回false
  */
  public function register($regArray);
  /**
  *getNextId方法接受不接受参数,查询用户信息表，获取当前行数，把行数+1返回
  *如果行数是0，则返回1
  */
  public function getNextId();
}
