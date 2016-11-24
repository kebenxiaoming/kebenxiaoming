<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/24
 * Time: 9:42
 */
namespace sunny;

class controller{

    protected $smarty;
    //构造方法，初始化模板引擎
    public function __construct(){
        $this->smarty=new \Smarty();
    }

    public function assign($name,$data){
        $this->smarty->assign($name,$data);
    }

    public function display($tpl){
        if(empty($tpl)){
            
        }
        $this->smarty->display($tpl);
    }
}