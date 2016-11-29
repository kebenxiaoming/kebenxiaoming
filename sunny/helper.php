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
        return new $classname;
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
        if(empty($new)){
           throw new Exception("输入有误，规则必须是类似index/index这种");
        }
        return "index.php?g=".Router::$module."&c=".$new[0]."&a=".$new[1];
    }
}
