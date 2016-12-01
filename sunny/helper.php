<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/28
 * Time: 11:54
 */
use sunny\Router;
use sunny\Config;
use sunny\Session;
use sunny\Cookie;

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
        if(!empty($name))
        {
            //引入新增的文件
            $classname = '\\app\\' . Router::$module . '\\' . $layer . '\\' . $name;
            $model = new $classname;
            $reflect = new \ReflectionMethod($model, "__construct");
            $reflect->invokeArgs($model, array($name));
            return $model;
        }else{
            $classname = '\\sunny\\Model';
            $model = new $classname;
            return $model;
        }
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
if (!function_exists('config')) {
    /**
     * 获取和设置配置参数
     * @param string|array  $name 参数名
     * @param mixed         $value 参数值
     * @param string        $range 作用域
     * @return mixed
     */
    function config($name = '', $value = null, $range = '')
    {
        if (is_null($value) && is_string($name)) {
            return 0 === strpos($name, '?') ? Config::has(substr($name, 1), $range) : Config::get($name, $range);
        } else {
            return Config::set($name, $value, $range);
        }
    }
}
if (!function_exists('session')) {
    /**
     * Session管理
     * @param string|array  $name session名称，如果为数组表示进行session设置
     * @param mixed         $value session值
     * @param string        $prefix 前缀
     * @return mixed
     */
    function session($name, $value = '', $prefix = null)
    {
        if (is_array($name)) {
            // 初始化
            Session::init($name);
        } elseif (is_null($name)) {
            // 清除
            Session::clear('' === $value ? null : $value);
        } elseif ('' === $value) {
            // 判断或获取
            return 0 === strpos($name, '?') ? Session::has(substr($name, 1), $prefix) : Session::get($name, $prefix);
        } elseif (is_null($value)) {
            // 删除
            return Session::delete($name, $prefix);
        } else {
            // 设置
            return Session::set($name, $value, $prefix);
        }
    }
}

if (!function_exists('cookie')) {
    /**
     * Cookie管理
     * @param string|array  $name cookie名称，如果为数组表示进行cookie设置
     * @param mixed         $value cookie值
     * @param mixed         $option 参数
     * @return mixed
     */
    function cookie($name, $value = '', $option = null)
    {
        if (is_array($name)) {
            // 初始化
            Cookie::init($name);
        } elseif (is_null($name)) {
            // 清除
            Cookie::clear($value);
        } elseif ('' === $value) {
            // 获取
            return 0 === strpos($name, '?') ? Cookie::has(substr($name, 1), $option) : Cookie::get($name);
        } elseif (is_null($value)) {
            // 删除
            return Cookie::delete($name);
        } else {
            // 设置
            return Cookie::set($name, $value, $option);
        }
    }
}
