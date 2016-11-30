<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/29
 * Time: 13:42
 */
namespace app\admin\controller;

class index extends base
{

    public function index()
    {
        print_r(model('user')->find(1));
    }

    public function test()
    {
        $this->assign("hehe","aaa");
        $this->success("hehe",url("index/index"));
    }
}