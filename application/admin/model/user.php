<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/28
 * Time: 11:50
 */
namespace app\admin\model;
use sunny\Model;
use sunny\Config;

class user extends Model
{
    public function getList()
    {
        $result=$this->select(Config::get("prefix").__CLASS__,"*");
        print_r($result);
    }
}