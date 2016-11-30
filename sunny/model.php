<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/11/24
 * Time: 15:55
 */
namespace sunny;
use sunny\db\Mysql;

class model
{
    //PDO连接
    protected $pdo=null;
    //表名
    protected $tablename="";
    //模型名
    protected $name="";
    // 事务指令数
    protected $transTimes = 0;
    //当前表的主键
    protected $pk;
    //最后一条sql的保存
    protected $lastSql;

    public function __construct($name="")
    {
        //单例模式获取pdo实例
        $this->pdo=Mysql::getInstance()->getPdo();
        //定义时传入表名
        $this->name=$name;
    }

    public function query($query)
    {
        $this->queryString = $query;

        return $this->pdo->query($query);
    }

    public function exec($query)
    {
        $this->queryString = $query;

        return $this->pdo->exec($query);
    }

    public function quote($string)
    {
        return $this->pdo->quote($string);
    }

    protected function array_quote($array)
    {
        $temp = array();

        foreach ($array as $value)
        {
            $temp[] = is_int($value) ? $value : $this->pdo->quote($value);
        }

        return implode($temp, ',');
    }

    protected function inner_conjunct($data, $conjunctor, $outer_conjunctor)
    {
        $haystack = array();

        foreach ($data as $value)
        {
            $haystack[] = '(' . $this->data_implode($value, $conjunctor) . ')';
        }

        return implode($outer_conjunctor . ' ', $haystack);
    }

    protected function data_implode($data, $conjunctor, $outer_conjunctor = null)
    {
        $wheres = array();

        foreach ($data as $key => $value)
        {
            if (($key == 'AND' || $key == 'OR') && is_array($value))
            {
                $wheres[] = 0 !== count(array_diff_key($value, array_keys(array_keys($value)))) ?
                    '(' . $this->data_implode($value, ' ' . $key) . ')' :
                    '(' . $this->inner_conjunct($value, ' ' . $key, $conjunctor) . ')';
            }
            else
            {
                preg_match('/([\w\.]+)(\[(\>|\>\=|\<|\<\=|\!|\<\>)\])?/i', $key, $match);
                if (isset($match[3]))
                {
                    if ($match[3] == '' || $match[3] == '!')
                    {
                        $wheres[] = $match[1] . ' ' . $match[3] . '= ' . $this->quote($value);
                    }
                    else
                    {
                        if ($match[3] == '<>')
                        {
                            if (is_array($value))
                            {
                                if (is_numeric($value[0]) && is_numeric($value[1]))
                                {
                                    $wheres[] = $match[1] . ' BETWEEN ' . $value[0] . ' AND ' . $value[1];
                                }
                                else
                                {
                                    $wheres[] = $match[1] . ' BETWEEN ' . $this->quote($value[0]) . ' AND ' . $this->quote($value[1]);
                                }
                            }
                        }
                        else
                        {
                            if (is_numeric($value))
                            {
                                $wheres[] = $match[1] . ' ' . $match[3] . ' ' . $value;
                            }
                        }
                    }
                }
                else
                {
                    if (is_int($key))
                    {
                        $wheres[] = $this->quote($value);
                    }
                    else
                    {
                        switch (gettype($value))
                        {
                            case 'NULL':
                                $wheres[] = $match[1] . ' IS null';
                                break;

                            case 'array':
                                $wheres[] = $match[1] . ' IN (' . $this->array_quote($value) . ')';
                                break;

                            default:
                                $wheres[] = $match[1] . ' = ' . $this->quote($value);
                                break;
                        }
                    }
                }
            }
        }

        return implode($conjunctor . ' ', $wheres);
    }

    public function where_clause($where)
    {
        $where_clause = '';

        if (is_array($where))
        {
            $single_condition = array_diff_key($where, array_flip(
                explode(' ', 'AND OR GROUP ORDER HAVING LIMIT LIKE MATCH')
            ));

            if ($single_condition != array())
            {
                $where_clause = ' WHERE ' . $this->data_implode($single_condition, '');
            }
            if (isset($where['AND']))
            {
                $where_clause = ' WHERE ' . $this->data_implode($where['AND'], ' AND ');
            }
            if (isset($where['OR']))
            {
                $where_clause = ' WHERE ' . $this->data_implode($where['OR'], ' OR ');
            }
            if (isset($where['LIKE']))
            {
                $like_query = $where['LIKE'];
                if (is_array($like_query))
                {
                    $is_OR = isset($like_query['OR']);

                    if ($is_OR || isset($like_query['AND']))
                    {
                        $connector = $is_OR ? 'OR' : 'AND';
                        $like_query = $is_OR ? $like_query['OR'] : $like_query['AND'];
                    }
                    else
                    {
                        $connector = 'AND';
                    }

                    $clause_wrap = array();
                    foreach ($like_query as $column => $keyword)
                    {
                        if (is_array($keyword))
                        {
                            foreach ($keyword as $key)
                            {
                                $clause_wrap[] = $column . ' LIKE ' . $this->quote('%' . $key . '%');
                            }
                        }
                        else
                        {
                            $clause_wrap[] = $column . ' LIKE ' . $this->quote('%' . $keyword . '%');
                        }
                    }
                    $where_clause .= ($where_clause != '' ? ' AND ' : ' WHERE ') . '(' . implode($clause_wrap, ' ' . $connector . ' ') . ')';
                }
            }
            if (isset($where['MATCH']))
            {
                $match_query = $where['MATCH'];
                if (is_array($match_query) && isset($match_query['columns']) && isset($match_query['keyword']))
                {
                    $where_clause .= ($where_clause != '' ? ' AND ' : ' WHERE ') . ' MATCH (' . implode($match_query['columns'], ', ') . ') AGAINST (' . $this->quote($match_query['keyword']) . ')';
                }
            }
            if (isset($where['GROUP']))
            {
                $where_clause .= ' GROUP BY ' . $where['GROUP'];
            }
            if (isset($where['ORDER']))
            {
                $where_clause .= ' ORDER BY ' . $where['ORDER'];
                if (isset($where['HAVING']))
                {
                    $where_clause .= ' HAVING ' . $this->data_implode($where['HAVING'], '');
                }
            }
            if (isset($where['LIMIT']))
            {
                if (is_numeric($where['LIMIT']))
                {
                    $where_clause .= ' LIMIT ' . $where['LIMIT'];
                }
                if (is_array($where['LIMIT']) && is_numeric($where['LIMIT'][0]) && is_numeric($where['LIMIT'][1]))
                {
                    $where_clause .= ' LIMIT ' . $where['LIMIT'][0] . ',' . $where['LIMIT'][1];
                }
            }
        }
        else
        {
            if ($where != null)
            {
                $where_clause .= ' ' . $where;
            }
        }
        return $where_clause;
    }
    //获取当前表信息
    public function getTableInfo($table="")
    {
        if(empty($table))
        {
            //带上配置的表前缀
            $table = Config::get("prefix") . $this->name;
        }elseif(!empty($this->tablename))
        {
            $table = Config::get("prefix") . $this->tablename;
        }else {
            $table = Config::get("prefix") .$table;
        }
        list($table) = explode(' ', $table);
        if(strpos($table,'.')){
            list($dbName,$tableName) = explode('.',$table);
            $sql   = 'SHOW COLUMNS FROM `'.$dbName.'`.`'.$tableName.'`';
        }else{
            $sql   = 'SHOW COLUMNS FROM `'.$table.'`';
        }
        $this->lastSql=$sql;
        $result = $this->query($sql);
        $info   =   array();
        if($result) {
            foreach ($result as $key => $val) {
                if(\PDO::CASE_LOWER != $this->pdo->getAttribute(\PDO::ATTR_CASE)){
                    $val = array_change_key_case ( $val ,  CASE_LOWER );
                }
                $info[$val['field']] = array(
                    'name'    => $val['field'],
                    'type'    => $val['type'],
                    'notnull' => (bool) ($val['null'] === ''), // not null is empty, null is yes
                    'default' => $val['default'],
                    'primary' => (strtolower($val['key']) == 'pri'),
                    'autoinc' => (strtolower($val['extra']) == 'auto_increment'),
                );
            }
        }
        return $info;
    }
    //获取当前表的主键
    public function getPk(){
        $info=$this->getTableInfo();
        foreach ($info as $k=>$val)
        {
            if($val['primary'])
            {
                $this->pk=$k;
                return $this->pk;
            }
        }
        return $this->pk;
    }
    //增加find方法
    public function find($value="")
    {
        if(empty($value)){
            throw new \PDOException("请传入要查询的主键值！！");
        }
        $columns="*";
        if(empty($table))
        {
            //带上配置的表前缀
            $table = Config::get("prefix") . $this->name;
        }elseif(!empty($this->tablename))
        {
            $table = Config::get("prefix") . $this->tablename;
        }else {
            $table = Config::get("prefix") .$table;
        }
        $where_clause = " WHERE ".$this->getPk()."=".$value;
        $this->lastSql='SELECT ' . (
            is_array($columns) ? implode(', ', $columns) : $columns
            ) . ' FROM ' . $table . $where_clause;
        $query = $this->query('SELECT ' . (
            is_array($columns) ? implode(', ', $columns) : $columns
            ) . ' FROM ' . $table . $where_clause);
        return $query ? $query->fetch(\PDO::FETCH_ASSOC)
            : false;

    }
    //加入排序条件
    public function select($table="", $columns="*", $where = null)
    {
        if(empty($table))
        {
            //带上配置的表前缀
            $table = Config::get("prefix") . $this->name;
        }elseif(!empty($this->tablename))
        {
            $table = Config::get("prefix") . $this->tablename;
        }else {
            $table = Config::get("prefix") .$table;
        }
        $where_clause = $this->where_clause($where);

        preg_match('/([a-zA-Z0-9_-]*)\s*(\[(\<|\>|\>\<|\<\>)\])?\s*([a-zA-Z0-9_-]*)/i', $table, $match);

        if ($match[3] != '' && $match[4] != '')
        {
            $join_array = array(
                '>' => 'LEFT',
                '<' => 'RIGHT',
                '<>' => 'FULL',
                '><' => 'INNER'
            );

            $table = $match[1] . ' ' . $join_array[ $match[3] ] . ' JOIN ' . $match[4] . ' ON ';
            $where_clause = str_replace(' WHERE ', '', $where_clause);
        }
        $query = $this->query('SELECT ' . (
            is_array($columns) ? implode(', ', $columns) : $columns
            ) . ' FROM ' . $table . $where_clause);
        $this->lastSql='SELECT ' . (
            is_array($columns) ? implode(', ', $columns) : $columns
            ) . ' FROM ' . $table . $where_clause;
        return $query ? $query->fetchAll(\PDO::FETCH_ASSOC)
            : false;
    }

    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = array();

        foreach ($data as $key => $value)
        {
            $values[] = is_array($value) ? serialize($value) : $value;
        }
        $this->lastSql='INSERT INTO ' . $table . ' (' . $keys . ') VALUES (' . $this->data_implode(array_values($values), ',') . ')';
        $this->exec('INSERT INTO ' . $table . ' (' . $keys . ') VALUES (' . $this->data_implode(array_values($values), ',') . ')');
        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $where = null)
    {
        $fields = array();

        foreach ($data as $key => $value)
        {
            if (is_array($value))
            {
                $fields[] = $key . '=' . $this->quote(serialize($value));
            }
            else
            {
                preg_match('/([\w]+)(\[(\+|\-)\])?/i', $key, $match);
                if (isset($match[3]))
                {
                    if (is_numeric($value))
                    {
                        $fields[] = $match[1] . ' = ' . $match[1] . ' ' . $match[3] . ' ' . $value;
                    }
                }
                else
                {
                    $fields[] = $key . ' = ' . $this->quote($value);
                }
            }
        }
        $this->lastSql='UPDATE ' . $table . ' SET ' . implode(',', $fields) . $this->where_clause($where);
        return $this->exec('UPDATE ' . $table . ' SET ' . implode(',', $fields) . $this->where_clause($where));
    }

    public function delete($table, $where)
    {
        $this->lastSql='DELETE FROM ' . $table . $this->where_clause($where);
        return $this->exec('DELETE FROM ' . $table . $this->where_clause($where));
    }

    public function replace($table, $columns, $search = null, $replace = null, $where = null)
    {
        if (is_array($columns))
        {
            $replace_query = array();

            foreach ($columns as $column => $replacements)
            {
                foreach ($replacements as $replace_search => $replace_replacement)
                {
                    $replace_query[] = $column . ' = REPLACE(' . $column . ', ' . $this->quote($replace_search) . ', ' . $this->quote($replace_replacement) . ')';
                }
            }
            $replace_query = implode(', ', $replace_query);
            $where = $search;
        }
        else
        {
            if (is_array($search))
            {
                $replace_query = array();

                foreach ($search as $replace_search => $replace_replacement)
                {
                    $replace_query[] = $columns . ' = REPLACE(' . $columns . ', ' . $this->quote($replace_search) . ', ' . $this->quote($replace_replacement) . ')';
                }
                $replace_query = implode(', ', $replace_query);
                $where = $replace;
            }
            else
            {
                $replace_query = $columns . ' = REPLACE(' . $columns . ', ' . $this->quote($search) . ', ' . $this->quote($replace) . ')';
            }
        }
        $this->lastSql='UPDATE ' . $table . ' SET ' . $replace_query . $this->where_clause($where);
        return $this->exec('UPDATE ' . $table . ' SET ' . $replace_query . $this->where_clause($where));
    }

    public function get($table, $columns, $where = null)
    {
        if (is_array($where))
        {
            $where['LIMIT'] = 1;
        }
        $data = $this->select($table, $columns, $where);

        return isset($data[0]) ? $data[0] : false;
    }

    public function has($table, $where)
    {
        $this->lastSql='SELECT EXISTS(SELECT 1 FROM ' . $table . $this->where_clause($where) . ')';
        return $this->query('SELECT EXISTS(SELECT 1 FROM ' . $table . $this->where_clause($where) . ')')->fetchColumn() === '1';
    }

    public function count($table, $where = null)
    {
        $this->lastSql='SELECT COUNT(*) FROM ' . $table . $this->where_clause($where);
        return 0 + ($this->query('SELECT COUNT(*) FROM ' . $table . $this->where_clause($where))->fetchColumn());
    }

    public function max($table, $column, $where = null)
    {
        $this->lastSql='SELECT MAX(' . $column . ') FROM ' . $table . $this->where_clause($where);
        return 0 + ($this->query('SELECT MAX(' . $column . ') FROM ' . $table . $this->where_clause($where))->fetchColumn());
    }

    public function min($table, $column, $where = null)
    {
        $this->lastSql='SELECT MIN(' . $column . ') FROM ' . $table . $this->where_clause($where);
        return 0 + ($this->query('SELECT MIN(' . $column . ') FROM ' . $table . $this->where_clause($where))->fetchColumn());
    }

    public function avg($table, $column, $where = null)
    {
        $this->lastSql='SELECT AVG(' . $column . ') FROM ' . $table . $this->where_clause($where);
        return 0 + ($this->query('SELECT AVG(' . $column . ') FROM ' . $table . $this->where_clause($where))->fetchColumn());
    }

    public function sum($table, $column, $where = null)
    {
        $this->lastSql='SELECT SUM(' . $column . ') FROM ' . $table . $this->where_clause($where);
        return 0 + ($this->query('SELECT SUM(' . $column . ') FROM ' . $table . $this->where_clause($where))->fetchColumn());
    }

    public function error()
    {
        return $this->pdo->errorInfo();
    }

    public function info()
    {
        return array(
            'server' => $this->pdo->getAttribute(\PDO::ATTR_SERVER_INFO),
            'client' => $this->pdo->getAttribute(\PDO::ATTR_CLIENT_VERSION),
            'driver' => $this->pdo->getAttribute(\PDO::ATTR_DRIVER_NAME),
            'version' => $this->pdo->getAttribute(\PDO::ATTR_SERVER_VERSION),
            'connection' => $this->pdo->getAttribute(\PDO::ATTR_CONNECTION_STATUS)
        );
    }
    /**
     * 启动事务
     * @access public
     * @return void
     */
    public function startTrans()
    {
        if ( !$this->pdo ) return false;
        //数据rollback 支持
        if ($this->transTimes == 0) {
            $this->pdo->beginTransaction();
        }
        $this->transTimes++;
        return ;
    }

    /**
     * 用于非自动提交状态下面的查询提交
     * @access public
     * @return boolean
     */
    public function commit()
    {
        if ($this->transTimes > 0) {
            $result = $this->pdo->commit();
            $this->transTimes = 0;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }

    /**
     * 事务回滚
     * @access public
     * @return boolean
     */
    public function rollback()
    {
        if ($this->transTimes > 0) {
            $result = $this->pdo->rollback();
            $this->transTimes = 0;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }
    //返回最后一条sql
    public function getLastSql(){
        return $this->lastSql;
    }
}
?>