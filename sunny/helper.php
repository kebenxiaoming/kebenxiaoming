<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/28
 * Time: 11:54
 */
use sunny\Router;

if (!function_exists('model')) {
    /**
     * 实例化Model
     * @param string    $name Model名称
     * @param string    $layer 业务层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \sunny\Model
     */
    function model($name = '', $layer = 'model')
    {
        //引入新增的文件
        $classname='\\app\\'.Router::$module.'\\'.$layer.'\\'.$name;
        $model=new $classname;
        $reflect=new \ReflectionMethod($model,"__construct");
        $reflect->invokeArgs($model,array($name));
        return  $model;
    }
}

if (!function_exists('url')) {
    /**
     * Url生成
     * @param string        $url 路由地址
     * @param string|array  $vars 变量
     * @return string
     */
    function url($url = '', $vars = '')
    {
        $new=explode("/",$url);
        if(empty($new)||count($new)<2){
           throw new Exception("输入有误，路由的方法url的输入规则必须是类似index/index这种！");
        }
        $newvars="";
        if(!empty($vars)&&is_array($vars)){
            foreach($vars as $k=>$val){
                if(in_array($k,array('g','c','a'))){
                    throw new Exception("输入有误，路由的方法url的输入传参中禁止使用默认的get参数：g,c,a！");
                }
                $newvars.="&".$k."=".strval($val);
            }
        }
        if(!empty($newvars))
        {
            return "index.php?g=".Router::$module."&c=".$new[0]."&a=".$new[1].$newvars;
        }
        return "index.php?g=".Router::$module."&c=".$new[0]."&a=".$new[1];
    }
}
