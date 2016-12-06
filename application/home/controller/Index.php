<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/23
 * Time: 15:46
 */
namespace app\home\controller;

class Index extends base
{
    public function index()
    {
        //查询出排序最高的三篇博客
        $blogs=model('Article')->limit(0,3)->order('sort DESC')->select();
        $this->assign("blogs",$blogs);
        $this->display();
    }

    public function test(){
        $this->assign("hehe","aaa");
        $this->success("hehe",url("index/index",array("tt"=>"pp","gg"=>11)));
    }
}