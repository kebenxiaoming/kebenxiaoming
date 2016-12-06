<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/5
 * Time: 15:04
 */
namespace app\admin\controller;

class Blog extends Base{
    public function index(){
        $count=model("Article")->count();
        $listrows=config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $articles=model("Article")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("news",$articles);
        $this->assign("page_html",$page->show());

        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }
}