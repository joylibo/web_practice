<?php
/**
 * Created by PhpStorm.
 * User: libo
 * Date: 2017/3/30
 * Time: 22:22
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use Think\Exception;
use Think\Log;
use think\Request;

class Users extends Controller
{
    public function register(Request $request)
    {
        $username = $request->post("username");
        $email = $request->post("email");
        $psw = $request->post("psw");
        if($this->isEmailExist($email)){
            return ["code"=>3,"msg"=>"邮箱已经存在"];
        }
        try{
            $ef_rows = Db::name('users')->insert(
                [
                    "email"=>$email,
                    "username"=>$username,
                    "psw"=>["exp","PASSWORD('".$psw."')"],
                    "last_update"=>date("Y-m-d h:i:sa")
                ]
            );
        }catch(Exception $e){
            $e->getCode();
            return
                "code:".$e->getCode()."<br>".
                "data:".dump($e->getData())."<br>".
                "file:".$e->getFile()."<br>".
                "message:".$e->getMessage()."<br>".
                "line:".$e->getLine()."<br>";
        }

        if($ef_rows){
            return "插入成功".time();
        }
    }

    public function getUser(){
        $data = Db::name('users')->find();
        //return $this->fetch();
        Log::record('记录这个信息吧','log');
        dump($data);
        return gettype($data);
    }

    private function isEmailExist($new_email){
        return Db::name('users')->where('email',$new_email)->count('*');
    }
}