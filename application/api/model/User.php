<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 9:59
 */
namespace app\api\model;
use sunny\Model;

class User extends Model
{
    protected $pk = 'user_id';
    //检测用户
    public function  login($username,$password){
        $where=array(
            "user_name"=>$username,
        );
        $userdata=$this->where($where)->find();
        if($userdata){
            if($userdata['password']==md5($password)){
                //更新token
                $now=time();
                $token=sha1(md5($userdata['user_id']."darling".$now));
                $userdata['token']=$token;
                $userdata['token_time']=$now;
                //更新登录信息
                $userdata['login_time']=$now;
                $userdata['login_ip']=getIp();
                $this->update($userdata);
                $data=array("group_id"=>$userdata['user_group']);
                $user_group = model("UserGroup")->where($data)->find();
                $userdata['user_group']=$user_group['group_id'];
                $userdata['user_role']=$user_group['group_role'];
                session("user",$userdata);
                return $userdata;
            }
        }
        return false;
    }

    //注册用户
    public function register($username,$password){
        $where=array(
            "user_name"=>$username,
        );
        $userdata=$this->where($where)->find();
        if(!empty($userdata)){
            $data=array(
                "status"=>0,
                "msg"=>"该用户名已经存在！"
            );
            return $data;
        }
        $now=time();
        $userdata['user_name']=$username;
        $userdata['password']=md5($password);
        $userdata['login_time']=$now;
        $userdata['status']=1;
        //普通用户账号组
        $userdata['user_group']=7;
        $userdata['login_ip']=getIp();
        $lastId=$this->save($userdata);
        if($lastId){
            $userdata['user_id']=$lastId;
            $userdata['token']=sha1(md5($lastId."darling".$now));
            $userdata['token_time']=$now;
            if($this->update($userdata)){
                $data=array(
                    "status"=>1,
                    "msg"=>$userdata
                );
                return $data;
            }else{
                $data=array(
                    "status"=>0,
                    "msg"=>"注册成功，但是更新token失败，请重新登录即可！"
                );
                return $data;
            }
        }else{
            $data=array(
                "status"=>0,
                "msg"=>"注册失败！！"
            );
            return $data;
        }
    }

    //token自动登录
    public function tokenLogin($token){
        if($token){
            $data=array("token"=>$token);
            $user=$this->where($data)->find();
            if(!empty($user)){
                $now=time();
                //判断token是否过期，过期则返回登录失败(过期时间为2小时)
                if($user['token_time']+2*60*60<$now){
                    return false;
                }
                //更新登录信息
                $user['login_time']=$now;
                $user['login_ip']=getIp();
                $this->update($user);
                $data=array("group_id"=>$user['user_group']);
                $user_group = model("UserGroup")->where($data)->find();
                $user['group_id']=$user_group['group_id'];
                $user['user_role']=$user_group['group_role'];
                session("user",$user);
                return true;
            }
        }else{
            return false;
        }
    }
    //更新token
    public function tokenRefresh(){
        $user=session("user");
        if($user){
            $data=array("user_id"=>$user['user_id']);
            $user=$this->where($data)->find();
            if(!empty($user)){
                $now=time();
                $token=sha1(md5($user['user_id']."darling".$now));
                $user['token']=$token;
                $user['token_time']=$now;
                //更新登录信息
                $result=$this->update($user);
                if($result) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}