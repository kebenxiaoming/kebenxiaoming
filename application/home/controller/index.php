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
        print_r(model('module')->field("module_id,module_name")->limit(0,2)->find());
        print_r(model("")->getLastSql());
    }

    public function test(){
        $this->assign("hehe","aaa");
        $this->success("hehe",url("index/index",array("tt"=>"pp","gg"=>11)));
    }
}