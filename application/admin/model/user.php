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

class user extends Model
{
    protected $tablename="user";

    public function getList()
    {
        $result=$this->find();
        print_r($result);
    }
}