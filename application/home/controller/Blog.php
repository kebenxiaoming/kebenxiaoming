<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/6
 * Time: 15:21
 */
namespace app\home\controller;

class Blog extends base
{
    public function index()
    {
        $count=model("Article")->count();
        $listrows=config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $articles=model("Article")->limit($page->firstRow,$page->listRows)->order('sort DESC')->select();
        $this->assign("blogs",$articles);
        $this->display();
    }

    public function show(){
        $id=input('get.id');
        $article=model('Article')->find($id);
        $this->assign("blog",$article);
        $this->display();
    }
}