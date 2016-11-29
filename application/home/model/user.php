<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/28
 * Time: 11:50
 */
namespace app\home\model;
use sunny\Model;
use sunny\Config;

class user extends Model{
    public function getList(){
        $result=$this->query("select * from ".Config::get('prefix')."user")->fetchAll();
        print_r($result);
    }
}