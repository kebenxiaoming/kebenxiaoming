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
