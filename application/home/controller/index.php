<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/23
 * Time: 15:46
 */
namespace app\home\controller;

class index extends base
{
    public function index()
    {
        model('user')->getList();
        $this->assign("test","demo");
        $this->display();
    }

    public function test(){
        $this->assign("hehe","aaa");
        $this->success("hehe",url("index",array("aa"=>"pp")));
    }
}