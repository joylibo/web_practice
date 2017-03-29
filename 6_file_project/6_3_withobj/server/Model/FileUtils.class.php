<?php

namespace Filepro\Model;
/**
 *
 */
require_once('FileUtils.interface.php');

class FileUtils implements iFileUtils
{
  public $fileUrl = '../data/userinf';

  function isEmailExits($newEmail){
    # 查看一个email地址是不是已经存在
    $probe = false;
    if(!file_exists($this->fileUrl)){
      @ $fp = fopen($this->fileUrl,'a');
      fclose($fp);
      return $probe;
    }
    $fp = fopen($this->fileUrl,'rb');
    while (!(feof($fp)||$probe)) {
      $user_arr = json_decode(fgets($fp));
      if (!isset($user_arr->email)) {
        break;
      }
      if($newEmail == $user_arr->email){
          $probe = true;
      }
    }
    fclose($fp);
    return $probe;
  }

  function register($regArray){
    try {
      @ $fp = fopen($this->fileUrl,'a');
      fwrite($fp,json_encode($regArray)."\r\n");
      fclose($fp);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  function getNextId(){
    # 获取下一行插入的数据应该是什么ID
    $id = 0;
    $fp = @fopen($this->fileUrl,'r');
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
}
