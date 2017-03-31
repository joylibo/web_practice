<?php
/**
 * Created by PhpStorm.
 * User: libo
 * Date: 2017/3/31
 * Time: 14:55
 */

namespace app\index\controller;


use think\Controller;

class Base extends Controller
{
    const SECCESS_RETURN = 1000;
    const ILLEGAL_ACT_VALUE = 1;
    const PSW_NOT_EQUAE = 2;
    const CAN_NOT_STORE = 3;
    const REGI_EMAIL_EXISTS = 4;
}