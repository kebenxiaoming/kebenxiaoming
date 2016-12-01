<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/1
 * Time: 14:13
 */
function Adminlog($user_name,$action,$class_name,$class_obj,$result){
    $data=array(
        "user_name"=>$user_name,
        "action"=>$action,
        "class_name"=>$class_name,
        "class_obj"=>$class_obj,
        "result"=>$result,
        "op_time"=>time()
    );
    $res=model("SysLog")->save($data);
    return $res;
}
function encrypt($value){
    if(!$value){return false;}
    $key = \sunny\Config::get('SECRET');
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
    return trim(base64_encode($crypttext)); //encode for cookie
}

function decrypt($value){
    if(!$value){return false;}
    $key =  config('SECRET');
    $crypttext = base64_decode($value); //decode cookie
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
}

function setCookieRemember($encrypted,$day=7){
    setcookie("sunny_remember",$encrypted,time()+3600*24*$day);
}

function getCookieRemember(){
    if(!empty(cookie('sunny_remember'))) {
        $encrypted = cookie("sunny_remember");
        $base64 = urldecode($encrypted);
        return decrypt($base64);
    }else{
        return "";
    }
}