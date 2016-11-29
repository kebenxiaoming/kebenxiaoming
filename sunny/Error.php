<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://zjzit.cn>
// +----------------------------------------------------------------------

namespace sunny;

class Error
{
    /**
     * 注册异常处理
     * @return void
     */
    public static function register()
    {
        error_reporting(E_ALL);
        set_error_handler([__CLASS__, 'appError']);
        set_exception_handler([__CLASS__, 'appException']);
        register_shutdown_function([__CLASS__, 'appShutdown']);
    }

    /**
     * Exception Handler
     * @param  \Exception|\Throwable $e
     */
    public static function appException($e)
    {
        if (!$e instanceof \Exception) {
            $e = new \Exception($e);
        }
        if (IS_CLI) {
           echo $e->getMessage().PHP_EOL;die;
        } else {
            if(!empty(ob_get_contents())){
                //清空缓存区
                ob_end_clean();
            }
            $errorStr =  $e->getMessage();
            require SUNNY_PATH."tpl/error.php";
            exit;
        }
    }

    /**
     * Error Handler
     * @param  integer $errno   错误编号
     * @param  integer $errstr  详细错误信息
     * @param  string  $errfile 出错的文件
     * @param  integer $errline 出错行号
     * @param array    $errcontext
     */
    public static function appError($errno, $errstr, $errfile = '', $errline = 0, $errcontext = [])
    {
        switch ($errno) {
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                ob_end_clean();
                $errorStr = "$errstr ".$errfile." 第 $errline 行.";
                self::halt($errorStr);
                break;
            default:
                if(!empty(ob_get_contents())){
                    //清空缓存区
                    ob_end_clean();
                }
                $errorStr = "[$errno] $errstr ".$errfile." 第 $errline 行.";
                require SUNNY_PATH."tpl/error.php";
                exit;
                break;
        }
    }

    /**
     * Shutdown Handler
     */
    public static function appShutdown()
    {
        if ($e = error_get_last()) {
            switch($e['type']){
                case E_ERROR:
                case E_PARSE:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:
                    self::halt($e);
                    break;
            }
        }
    }

    /**
     * 确定错误类型是否致命
     *
     * @param  int $type
     * @return bool
     */
    protected static function isFatal($type)
    {
        return in_array($type, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE]);
    }

    /**
     * 错误输出
     * @param mixed $error 错误
     * @return void
     */
    static public function halt($error) {
        $e = array();
        if (APP_DEBUG || IS_CLI) {
            //调试模式下输出错误信息
            if (!is_array($error)) {
                $trace          = debug_backtrace();
                $e['message']   = $error;
                $e['file']      = $trace[0]['file'];
                $e['line']      = $trace[0]['line'];
                ob_start();
                debug_print_backtrace();
                $e['trace']     = ob_get_clean();
            } else {
                $e              = $error;
            }
            if(IS_CLI){
                exit(iconv('UTF-8','gbk',$e['message']).PHP_EOL.'FILE: '.$e['file'].'('.$e['line'].')'.PHP_EOL.$e['trace']);
            }
        } else {
            $message        = is_array($error) ? $error['message'] : $error;
            $e['message']   =$message;
        }
        if(!empty(ob_get_contents())){
            //清空缓存区
            ob_end_clean();
        }
        $errorStr = $e['message'];
        require SUNNY_PATH."tpl/error.php";
        exit;
    }

}
