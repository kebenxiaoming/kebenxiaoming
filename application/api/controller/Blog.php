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
        $articles=model("Article")->field("id,views,title,pics,description,create_time")->limit($page->firstRow,$page->listRows)->select();
        if(!empty($articles)) {
            foreach ($articles as $k => $val) {
                if (!empty($val['pics'])) {
                    $where = "id IN (" . $val['pics'] . ")";
                    $files = model("File")->where($where)->select();
                    foreach($files as $key=>$v){
                        $articles[$k]["realpath"]="http://kebenxiaoming.info/uploads/".$v['savepath'];
                        break;
                    }
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
    //编辑博客
    public function detail(){
            $id=input("post.id");
            $data=model("Article")->find($id);
            if(!empty($data)){
                $this->ajaxReturn($data,1,"获取详情成功！");die;
            }else{
                $this->ajaxReturn("",0,"获取详情失败！");die;
            }
    }
}