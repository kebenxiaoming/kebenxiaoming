<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/28
 * Time: 11:50
 */
namespace app\admin\model;
use sunny\model;
use sunny\Config;

class user extends model{
    public function getList(){
        $result=$this->query("select * from ".Config::get('prefix')."user")->fetchAll();
        print_r($result);
    }
}