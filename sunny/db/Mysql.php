<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/30
 * Time: 10:23
 */
namespace sunny\db;
use sunny\Config;

class Mysql{
    //保存类实例的连接
    protected $pdo=null;
    //保存类实例的静态成员变量
    private static $_instance;
    // Optional
    protected $charset = 'utf8';
    //最后一条Sql
    protected $lastSql="";

    public function __construct()
    {
        try {
            $this->server = Config::get('hostname');
            $this->port = Config::get('hostport');
            $this->username = Config::get('username');
            $this->password = Config::get('password');
            $this->database_name = Config::get('database');

            $this->pdo = null;
            $this->pdo = new \PDO('mysql:host=' . $this->server . ';port=' . $this->port . ';dbname=' . $this->database_name, $this->username, $this->password);
            $this->pdo->exec('SET NAMES \'' . $this->charset . '\'');
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    //创建__clone方法防止对象被复制克隆
    public function __clone(){
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }

    //单例方法,用于访问实例的公共的静态方法
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function getPdo(){
        return $this->pdo;
    }

    public function setLastSql($sql){
        $this->lastSql=$sql;
    }

    public function getLastSql(){
        return $this->lastSql;
    }
}