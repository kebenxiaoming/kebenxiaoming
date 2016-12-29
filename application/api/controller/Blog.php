<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/5
 * Time: 15:04
 */
namespace app\api\controller;

class Blog extends Base{
    public function index(){
        $count=model("Article")->count();
        $listrows=config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $articles=model("Article")->field("views,title,pics,description,create_time")->limit($page->firstRow,$page->listRows)->select();
        if(!empty($articles)) {
            foreach ($articles as $k => $val) {
                if (!empty($val['pics'])) {
                    $where = "id IN (" . $val['pics'] . ")";
                    $files = model("File")->where($where)->select();
                    foreach($files as $key=>$v){
                        $files[$k]["realpath"]="http://kebenxiaoming.info/uploads/".$v['savepath'];
                    }
                    $articles[$k]['picsdetail'] = $files;
                }
            }
            $data=array(
                "articles"=>$articles,
                "nowpage"=>$page->getNowPage()
            );
            $this->ajaxReturn($data,1,"获取数据成功！");
        }else{
            $this->ajaxReturn("",0,"获取数据失败或者没有更多数据了！");
        }
    }

    //新增
    public function add(){
        if(IS_POST) {
            $data=input('post.');
            if (!empty($data)) {
                if(empty($data['sort'])){
                    $data['sort']=0;
                }
                if($data['editor']=="markdown") {
                    if (!empty($data['content'])) {
                        $parser = new \cebe\markdown\Markdown();
                        $data['content'] = $parser->parse($data['content']);
                    }
                }
                unset($data['editor']);
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
        if (input('get.editor') == 'markdown') {
                $this->assign('editor', "markdown");
            } else {
                $this->assign('editor', "kindeditor");
         }
        $this->display();
    }
    //编辑博客
    public function show(){
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
                if($data['editor']=="markdown") {
                    if (!empty($data['content'])) {
                        $parser = new \cebe\markdown\Markdown();
                        $data['content'] = $parser->parse($data['content']);
                    }
                }
                unset($data['editor']);
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
        if (input('get.editor') == 'markdown') {
            $this->assign('editor', "markdown");
        } else {
            $this->assign('editor', "kindeditor");
        }
        $this->display();
    }
}