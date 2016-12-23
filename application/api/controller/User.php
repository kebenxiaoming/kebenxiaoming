<?php
/**
 * Created by sunny.
 * User: sunny
 * Have a nice day!
 * Date: 2016/12/23
 * Time: 11:20
 */
namespace app\api\controller;

class User extends Base{
    public function _initialize()
    {
        parent::_initialize();
        $user=session("user");
        if(empty($user)){
            $this->ajaxReturn("",0,"请先登录！1");
        }
    }

    public function index(){
        
    }

}