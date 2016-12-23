<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 15:06
 */
namespace app\api\model;
use sunny\Model;

class UserGroup extends Model{

    protected $tablename="user_group";

    public function getAllGroup(){
        $list=$this->select();
        if (!empty($list)) {
                return $list;
        }
        return array ();
    }

    public function getGroupForOptions() {
        $group_list = $this->getAllGroup ();
        $group_options_array=array();
        foreach ( $group_list as $group ) {
            $group_options_array [$group ['group_id']] = $group ['group_name'];
        }

        return $group_options_array;
    }
}