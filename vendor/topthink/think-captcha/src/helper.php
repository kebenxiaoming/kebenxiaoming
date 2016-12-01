<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------



/**
 * @param string $id
 * @param array  $config
 * @return \sunny\Response
 */
function captcha($id = "", $config = [])
{
    $captcha = new \think\captcha\Captcha($config);
    return $captcha->entry($id);
}


/**
 * @param $id
 * @return string
 */
function captcha_src($id = "")
{
    $captcha=new think\captcha\CaptchaController();
    return $captcha->index($id);
}


/**
 * @param $id
 * @return mixed
 */
function captcha_img($id = "")
{
    return '<img src="' . captcha_src($id) . '" alt="captcha" />';
}


/**
 * @param        $value
 * @param string $id
 * @param array  $config
 * @return bool
 */
function captcha_check($value, $id = "", $config = [])
{
    $captcha = new \think\captcha\Captcha($config);
    return $captcha->check($value, $id);
}

