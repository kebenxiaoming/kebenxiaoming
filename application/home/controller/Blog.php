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
        if(empty($article)){
            $this->error("未获取到文章信息！");die;
        }
        //使得阅读数加1
        $sql="update ".config("prefix")."article set views=views+1 where id = ".$id;
        model()->exec($sql);
        //查出评论来
        $comments=model("Comment")->limit(0,3)->select();
        if(!empty($comments)){
            $this->assign("comments",$comments);
        }
        $this->assign("blog",$article);
        $this->display();
    }
    //ajax加载评论
    public function ajaxLoadComments(){
        $id=input("get.id");
        if(empty($id)){
            $this->ajaxReturn("",0,"未获取到文章id!");
        }
        $where['article_id']=$id;
        $count=model("Comment")->where($where)->count();
        $listrows=3;
        $page=new \sunny\Page($count,$listrows);
        $comments=model("Comment")->where($where)->limit($page->firstRow,$page->listRows)->order("create_time DESC")->select();
        if(!empty($comments)) {
            foreach($comments as $k=>$v){
                $comments[$k]['create_time']=date("Y-m-d H:i:s",$v['create_time']);
            }
            $data['comments']=$comments;
            if(count($data['comments'])<3){
                $data['has_more']=false;
            }elseif($count==count($data['comments'])){
                $data['has_more']=false;
            }else{
                $data['now_page']=$page->getNowPage();
                $data['has_more']=true;
            }
            $this->ajaxReturn($data,1,"获取数据成功！");
        }else{
            $this->ajaxReturn("",0,"获取数据失败！");
        }
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

    //添加文章回复
    public function comment(){
        $id=input("post.id");
        $content=input("post.content");
        if(empty($id)||empty($content)){
            $this->ajaxReturn("",0,"所传参数存在空值!");
        }
        $article=model("Article")->find($id);
        if(empty($article)){
            $this->ajaxReturn("",0,"未获取到该文章信息！");
        }
        $data=array(
            "article_id"=>$id,
            "uid"=>0,
            "content"=>$content,
            "create_time"=>time()
        );
        if(model("Comment")->save($data)){
            $data['create_time']=date("Y-m-d H:i:s",$data['create_time']);
            $this->ajaxReturn($data,1,"评论成功！");
        }else{
            $this->ajaxReturn("",0,"评论失败！");
        }
    }
    //添加评论回复
    public function reply(){
        //要回复的评论id
        $comment_id=input("post.comment_id");
        //要回复的如果是评论的回复
        $reply_id=input("post.reply_id");
        //评论内容
        $content=input("post.content");
        //还有回复人和被回复人没加，目前没有用户模块暂时不用
        if(empty($comment_id)||empty($content)){
            $this->ajaxReturn("",0,"所传参数存在空值!");
        }
        $comment=model("Comment")->find($comment_id);
        if(empty($comment)){
            $this->ajaxReturn("",0,"未获取到该评论信息！");
        }
        $data=array(
            "comment_id"=>$comment_id,
            "reply_id"=>$reply_id,//不存在则为0
            "from_uid"=>0,
            "to_uid"=>0,
            "content"=>$content,
            "create_time"=>time()
        );
        if(model("Reply")->save($data)){
            $this->ajaxReturn("",1,"回复评论成功！");
        }else{
            $this->ajaxReturn("",0,"回复评论失败！");
        }
    }
}