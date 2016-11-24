<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/23
 * Time: 15:46
 */
namespace app\home\controller;

class index extends base{

    public function index()
    {
        $this->assign("aa","hehe");
        $this->display();
    }
}