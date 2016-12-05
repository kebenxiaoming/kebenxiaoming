<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 16:18
 */
namespace app\admin\controller;

class Syslog extends Base{
    //日志列表
    public function index(){
        $count=model("SysLog")->count();
        $listrows=config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $logs=model("SysLog")->limit($page->firstRow,$page->listRows)->select();
        foreach($logs as &$log){

            if(array_key_exists($log['action'],config("COMMAND_FOR_LOG"))){
                $log['action']=config("COMMAND_FOR_LOG")[$log['action']];
            }

            $class_obj = $log['class_obj'];
            if(array_key_exists($log['class_name'],config("CLASS_FOR_LOG"))){
                $log['class_name'] = config("CLASS_FOR_LOG")[$log['class_name']];
            }


            if($log['class_obj']==""){
                $log['class_obj']='null';
            }

            if(empty($log['result'])){
                $log['result'] = '成功';
            }else{
                $result =json_decode($log['result'],true);
                if(is_array($result)){
                    $temp = null;
                    foreach($result as $key => $value){
                        if(!is_array($value)) {
                            $temp[] = "$key=>$value";
                        }
                    }
                    if(!empty($temp)) {
                        $log['result'] = implode(';', $temp);
                    }
                }else{
                    $log['result']=$result;
                }
            }
            $record=$log['action'] . " " . $log['result'];
            if(mb_strlen($record,"utf8")>50) {
                $log['record'] = mb_substr($log['action'] . " " . $log['result'], 0,50, "utf8")."...";
            }else{
                $log['record']=$record;
            }
        }
        $this->assign("logs",$logs);
        $this->assign("page_html",$page->show());
        $this->display();
    }
}