<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/24
 * Time: 16:22
 */
namespace app\home\controller;
use sunny\Controller;

class base extends Controller
{
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