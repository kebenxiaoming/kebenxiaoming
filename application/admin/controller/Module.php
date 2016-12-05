<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 16:32
 */
namespace app\admin\controller;

class Module extends Base{
    public function index(){
        $count=model("Module")->count();
        $listrows=config("LISTROWS")?config("LISTROWS"):10;
        $page=new \sunny\Page($count,$listrows);
        $modules=model("Module")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("modules",$modules);
        $this->assign("page_html",$page->show());
        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }
    //修改模块内容
    public function edit(){
        if(IS_POST) {
            $module = model("Module");
            $data=input("post.");
            $res = $module->update($data);
            if ($res>=0) {
                Adminlog(session("user")['user_name'],"MODIFY" , "Module", $data['module_id'] ,json_encode($data) );
                $this->success("修改成功！", url("Module/index"));die;
            } else {
                $this->error("修改失败！", url("Module/index"));die;
            }
        }else{
            $module_id=intval(input('param.module_id'));
            $module=model("Module")->find($module_id);
            if(empty($module)){
                $this->error("未获取到该模块！");die;
            }
            $this->assign("currentmodule",$module);
            $this->display();
        }
    }

    public function add(){
        if(IS_POST) {
            $module = model("Module");
            $data =input("post.");
            $res = $module->save($data);
            if ($res) {
                Adminlog(session("user")['user_name'],"ADD" , "Module",$res ,json_encode($data) );
                $this->success("添加成功！", url("Module/index"));
                die;
            } else {
                $this->error("添加失败！", url("Module/index"));
                die;
            }
        }else{
            $this->display();
        }
    }

    //删除模块内容
    public function delete(){
            $data['module_id']=intval(input('param.module_id'));
            //先查找是否存在
            $moduleobj=model("Module")->where($data)->find();
            if(empty($moduleobj)){
                $this->error("不存在该模块");die;
            }
            $res = model("Module")->where($data)->delete();
            if ($res) {
                Adminlog(session("user")['user_name'],"DEL" , "Module",$data['module_id'] ,json_encode($moduleobj) );
                $this->success("删除成功！", url("Module/index"));die;
            } else {
                $this->error("删除失败！", url("Module/index"));die;
            }
    }
}