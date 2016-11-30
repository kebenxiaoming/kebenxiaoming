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
    protected $tablename="module";

    public function getList()
    {
        $where=array("module_id"=>1);
        $result=$this->select($this->tablename,"*",$where);
        print_r($result);
    }
}