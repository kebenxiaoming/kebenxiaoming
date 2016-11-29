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
        model('user')->getList();
        $this->assign("test","demo");
        $this->display();
    }

    public function test()
    {
        $this->assign("hehe","aaa");
        $this->success("hehe",url("index/index"));
    }
}