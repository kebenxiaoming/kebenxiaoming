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
        $listrows=6;//config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $articles=model("Article")->limit($page->firstRow,$page->listRows)->order('sort DESC')->select();
        $this->assign('current_page',$page->getNowPage());
        if($page->getTotalPages()>$page->getNowPage()){
            $this->assign("has_more",true);
        }else{
            $this->assign("has_more",false);
        }
        $this->assign("blogs",$articles);
        $this->display();
    }

    public function show(){
        $id=input('get.id');
        if(empty($id)){
            $this->error("未获取到id！");die;
        }
        $article=model('Article')->find($id);
        //使得阅读数加1
        $sql="update ".config("prefix")."article set views=views+1 where id = ".$id;
        model()->exec($sql);
        $this->assign("blog",$article);
        $this->display();
    }

    //ajax返回数据
    public function ajaxLoadPage(){
        $count=model("Article")->count();
        $listrows=6;
        $page=new \sunny\Page($count,$listrows);
        $articles=model("Article")->limit($page->firstRow,$page->listRows)->order('sort DESC')->select();
        if(!empty($articles)) {
            foreach ($articles as $key => $val) {
                if (!empty($val['pics'])) {
                    $articles[$key]['imageurl'] = getImg($val['pics']);
                }
                $articles[$key]['url'] = url('Blog/show', array('id' => $val['id']));
            }
            $data=array(
                'status'=>1,
                'now_page'=>$page->getNowPage(),
                'articles'=>$articles
            );
        }else{
            $data=array(
                'status'=>0,
                'now_page'=>$page->getNowPage(),
                'articles'=>$articles
            );
        }
        echo json_encode($data);die;
    }
}