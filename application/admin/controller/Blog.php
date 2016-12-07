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

    //新增
    public function add(){
        if(IS_POST) {
            $data=input('post.');
            if (!empty($data)) {
                if(empty($data['sort'])){
                    $data['sort']=0;
                }
                $data['status']=1;
                $now=time();
                $data['create_time']=$now;
                $data['update_time']=$now;
                if ($res = model("Article")->save($data)) {
                    $this->success("新增文章成功！",url('Blog/index'));
                    die;
                } else {
                    $this->error("新增文章失败！",url('Blog/add'));
                    die;
                }
            } else {
                $this->error("获取数据失败！",url('Blog/add'));
                die;
            }
        }
        $this->display();
    }
    //编辑博客
    public function edit(){
        if(IS_POST) {
            $data=input('post.');
            if (!empty($data)) {
                if(empty($data['sort'])){
                    $data['sort']=0;
                }
                $id=input('get.id');
                $data['id']=$id;
                $now=time();
                $data['update_time']=$now;
                if ($res = model("Article")->update($data)) {
                    $this->success("编辑文章成功！",url('Blog/index'));
                    die;
                } else {
                    $this->error("编辑文章失败！",url('Blog/index'));
                    die;
                }
            } else {
                $this->error("获取数据失败！",url('Blog/index'));
                die;
            }
        }else{
            $id=input("get.id");
            $news=model("Article")->find($id);
            if(!empty($news)){
                //图片
                if(!empty($news['pics'])){
                    $where="id IN (".$news['pics'].")";
                    $files = model("File")->where($where)->select();
                    $this->assign("pics", $files);
                }
                $this->assign("article",$news);
            }else{
                $this->error("未获取到文章详情！");die;
            }
        }
        $this->display();
    }

    //删除
    public function del(){
        $id=input('get.id');
        if($res=model("Article")->where("id=".$id)->delete()){
            $this->success("删除成功!",url('Blog/index'));die;
        }else{
            $this->error("删除失败！",url('Blog/index'));die;
        }
    }
}