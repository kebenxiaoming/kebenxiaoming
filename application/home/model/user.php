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

class user extends Model
{
    private $tablename="user";

    public function getList()
    {
        $where=array("user_id"=>1);
        $result=$this->select(Config::get("prefix").$this->tablename,"*",$where);
        print_r($result);
    }

    public function test()
    {

    }
}