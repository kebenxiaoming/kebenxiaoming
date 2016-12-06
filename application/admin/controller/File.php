<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/9/30
 * Time: 14:27
 */
namespace app\admin\controller;

class File extends Base{
    public function uploadEdit(){

        $return  = array('error' => 0, 'url' => '');
        /* 调用文件上传组件上传文件 */
        $info=model("File")->upload("imgFile");
        /* 记录附件信息 */
        if($info){
            $return['url'] = "/uploads".DS.$info['info']['savepath'];
        } else {
            $return['error']=1;
        }
        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }

    //编辑器上传文件
    public function uploadPicture(){
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
        /* 调用文件上传组件上传文件 */
        $info=model("File")->upload("Filedata");
        /* 记录附件信息 */
        if($info){
            $info['info']['ossres']="/uploads".DS.$info['info']['savepath'];
            $return['data'] = $info['info'];
            $return['info'] = "上传成功！";
        } else {
            $return['status'] = 0;
            $return['info']   = $info['info'];
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}