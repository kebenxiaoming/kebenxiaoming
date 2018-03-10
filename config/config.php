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
    'password'       => 'shejiyuan888',
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
    //URL模式
    'URL_MODE'=>1,
    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
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
    //验证码
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 15,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度
        'imageH'   => 30,
        // 验证码图片宽度
        'imageW'   => 100,
        // 验证码位数
        'length'   => 4,
        // 验证成功后是否重置
        'reset'    => true
    ],
    //公共资源文件路径
    'PUBLIC'=>'/public',
    //网页title'
    'TITLE'=>'CMS后台管理',
    //分页的单页数目
    'LISTROWS'=>10,
    //分页变量名
    'VAR_PAGE'=>'p',
    //日志的解释配置
    "COMMAND_FOR_LOG" => [
        'SUCCESS' => '成功',
        'ERROR' => '失败',
        'ADD' => '增加',
        'DELETE' => '删除',
        'MODIFY' => '修改',
        'LOGIN' => '登录',
        'LOGOUT' => '退出',
        'PAUSE' => '封停',
        'PLAY' => '解封',
        'DEL' => '删除',
    ],
    //模型

    "CLASS_FOR_LOG" => [
        'ALL' => '全部',
        'User' => '用户',
        'UserGroup' => '账号组',
        'Module' => '菜单模块',
        'MenuUrl' => '功能',
        'GroupRole' => '权限',
    ],
];
