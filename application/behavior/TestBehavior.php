<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/13
 * Time: 9:26
 */
namespace app\behavior;
/**
 * 行为扩展：测试
 */
class TestBehavior

{

    public function run(&$params) {
        // 代理访问检测
        echo $params;
    }

}
