<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/24
 * Time: 9:42
 */
namespace sunny;

class controller
{
    //自定义一个模板变量用来存储传来的数据
    public $vars=array();

    /**
     * 模板赋值方法
     * @param $name
     * @param $data
     */
    public function assign($name,$data)
    {
        if(!empty($name)) {
            $this->vars = array_merge($this->vars, array($name => $data));
        }
    }

    /**
     * 引入模板方法
     * @param string $tpl
     */
    public function display($tpl="")
    {
        if(empty($tpl)){
            $tpl=Router::$controller.'/'.Router::$action;
        }
        $realtpl=APP_PATH.Router::$module."/view/".$tpl.".php";
        require $realtpl;
    }

    /**
     * 成功方法
     * @param $message
     * @param string $url
     * @param int $status
     */
    public function success($message,$url="",$status=1)
    {
        $this->redirect($message,$status,$url);
    }

    /**
     * 失败方法
     * @param $message
     * @param string $url
     * @param int $status
     */
    public function error($message,$url="",$status=0)
    {
        $this->redirect($message,$status,$url);
    }

    /**
     * 重定向方法
     * @param string $message
     * @param int $status
     * @param string $url
     * @param int $wait
     */
    public function redirect($message="",$status=0,$url="",$wait=1)
    {
        $msg=$message;
        $code=$status;
        if(empty($url)) {
            $url=$_SERVER['REQUEST_URI'];
        }else {
            $url = $url;
        }
        $wait=$wait;
        require SUNNY_PATH."tpl/redirect.php";
    }
}