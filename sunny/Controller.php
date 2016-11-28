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
    //自定义一个模板变量用来存储传来的数据
    public $vars=array();

    public function assign($name,$data){
        if(!empty($name)) {
            $this->vars = array_merge($this->vars, array($name => $data));
        }
    }

    public function display($tpl=""){
        if(empty($tpl)){
            $tpl=Router::$controller.'/'.Router::$action;
        }
        $realtpl=APP_PATH.Router::$module."/view/".$tpl.".php";
        require $realtpl;
    }
}