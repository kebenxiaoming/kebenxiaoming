<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/9/28
 * Time: 11:53
 */
namespace app\admin\controller;
use sunny\Controller;
use sunny\Request;

class Base extends Controller
{
    protected $request;

    public function _initialize()
    {
        $this->request=Request::instance();
        define('IS_GET',$this->request->isGet());
        define('IS_POST',       $this->request->isPost());
        define('IS_PUT',        $this->request->isPut());
        define('IS_DELETE',     $this->request->isDelete());
        //查看是否存在记录cookie
        $user_id=getCookieRemember();
        if($user_id){
            //自动登录
            if(empty(session("user"))){
                model("User")->autoLogin($user_id);
            }
        }
        //判断用户是否登录，已经登录直接进入页面内
        $user=session("user");
        if(empty($user)){
            //如果没登录自动跳转到登录页面
            if($this->request->controller()!="Login") {
                $this->redirect(url("Login/index"));
            }
        }else{
            if($this->request->controller()=="Login"&&$this->request->action()=="index") {
                $this->redirect("Index/index");
            }elseif($this->request->action()=="del"||$this->request->action()=="delete"||$this->request->action()=="category_del"){
                //如果是退出直接不操作
            }else {
                $this->assign("user_info", $user);
                //并且获取用户对应的目录权限
                // 显示菜单、导航条、模板
                $sidebar = model("MenuUrl")->getTrees();
                $menu = model("MenuUrl")->getMenuByUrl($this->request->controller()."/".$this->request->action());
                if(!empty($menu)) {
                    $this->assign('page_title', $menu['menu_name']);
                    $this->assign('content_header', $menu);
                    $this->assign('current_module_id', $menu['module_id']);
                    //验证用户权限
                    $this->checkAccess($menu, $user);
                }
                $this->assign('sidebar', $sidebar);
            }
        }
    }

    //检测用户权限
    private function checkAccess($menu,$user){
        if(!empty($user)) {
            $group_role = model("UserGroup")->field("group_role")->where("group_id=" . $user['user_group'])->find();
        }else{
            $this->error("请先登录！");die;
        }
        if(!in_array($menu['menu_id'],explode(',',$group_role['group_role']))){
            $this->error("对不起，您没有权限访问该地址！");die;
        }
    }

    public function showError($error){
        $this->assign("error",$error);
    }

    //返回json数据
    public function ajaxReturn($data){
        echo json_encode($data);die;
    }
}
