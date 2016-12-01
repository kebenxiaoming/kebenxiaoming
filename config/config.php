<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/22
 * Time: 17:19
 */
return [
    // 数据库类型
    'db_type'           => 'pdo_mysql',
    // 服务器地址
    'hostname'       => '127.0.0.1',
    // 数据库名
    'database'       => 's_admin',
    // 用户名
    'username'       => 'root',
    // 密码
    'password'       => '',
    // 端口
    'hostport'       => '3306',
    // 连接dsn
    'dsn'            => '',
    // 数据库连接参数
    'params'         => [],
    // 数据库编码默认采用utf8
    'charset'        => 'utf8',
    // 数据库表前缀
    'prefix'         => 'darling_',
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter' => '',
    //默认模块名
    'default_module' =>'home',
    //路由模式
    'default_router'=>1,
    //加密用户id用的密钥
    'SECRET'=>"haveaniceday",
    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => PUBLIC_PATH."cache",
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'sunny',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],
];