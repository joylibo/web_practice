<?php
namespace app\index\controller;

use think\Log;

class Index
{
    use \traits\controller\Jump;

    public function index()
    {

        $this->redirect('/src/html/index.html',0);
    }
}
