<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/9/28
 * Time: 11:53
 */
namespace app\api\controller;
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
        $token=input("get.token");
        if($token){
            //token自动登录
            if(empty(session("user"))){
                $result=model("User")->tokenLogin($token);
                if(!$result) {
                    $this->ajaxReturn(
                        "", 0, "token已经过期或者出错，请重新登录！"
                    );
                }
            }
        }
        //判断用户是否登录，已经登录直接进入页面内
//        $user=session("user");
//        if(empty($user)){
//            //如果没登录判断是否上传了username以及password
//            $username=input("post.username");
//            $password=input("post.password");
//            if(empty($username)||empty($password)){
//                    $this->ajaxReturn(
//                        "", 0, "未获取到用户信息，请重试！！"
//                    );
//            }
//        }
    }

    //返回json数据
    public function ajaxReturn($data,$status,$msg){
        $result=array(
            "data"=>$data,
            "msg"=>$msg,
            "status"=>$status
        );
        echo json_encode($result);die;
    }
}
