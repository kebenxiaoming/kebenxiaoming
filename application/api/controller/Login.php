<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/9/28
 * Time: 15:30
 */
namespace app\api\controller;

class Login extends Base
{
    //登录用户
    public function index(){
        if(IS_POST){
                $username=input('post.user_name');
                $password=input('post.password');
                //在检测用户名和密码
                $result=model("User")->login($username,$password);
                if($result){
                    $this->ajaxReturn($result,1,"登陆成功！！");
                }else{
                    $this->ajaxReturn("",0,"登陆失败！！");
                }
        }else{
            $this->ajaxReturn("",0,"请使用正确的请求方式！！");
        }
    }
    //注册用户
    public function register(){
        //使用用户名和密码直接注册
        if(IS_POST){
            $username=input('post.user_name');
            $password=input('post.password');
            //在检测用户名和密码
            $result=model("User")->register($username,$password);
            if($result['status']==0){
                $this->ajaxReturn("",0,$result['msg']);
            }else{
                $this->ajaxReturn($result['msg'],1,"注册成功！");
            }
        }else{
            $this->ajaxReturn("",0,"请使用正确的请求方式！！");
        }
    }

    //退出时更新token使得token无效
    public function logout(){
        //清空session和缓存
        session("user",null);
        $result=model("User")->tokenRefresh();
        if($result){
            $this->ajaxReturn(
                "", 1, "退出成功！"
            );
        }else{
            $this->ajaxReturn(
                "", 0, "退出失败，请重试！"
            );
        }
    }
}
