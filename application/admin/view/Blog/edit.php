<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
<script src="<?php echo config('PUBLIC');?>/Admin/js/jquery.uploadifive.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo config('PUBLIC');?>/Admin/css/uploadifive.css">
<div class="cpgl_cplb">
    <form method="post" action="">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cptj">
            <tr>
                <td height="80">标题</td>
                <td><input name="title" type="text" class="cpgl_cptj_mc" value="<?php echo $this->vars['article']['title'];?>" required="true"></td>
            </tr>
            <tr>
                <td width="106" height="80">所属分类菜单</td>
                <td width="749"><div class="cpgl_cptj_xl">
                        <select name="cat_id" style="margin:5px 0px 0px">
                            <option value="0">暂无</option>
                        </select>
                    </div></td>
            </tr>
            <tr>
                <td height="200">简介</td>
                <td><textarea name="description" type="text" class="cpgl_cptj_mc" required="true"  style="width:400px;height:200px;" ><?php echo $this->vars['article']['description'];?></textarea></td>
            </tr>
            <input type="hidden" value="<?php echo $this->vars['article']['pics'];?>" name="pics" id="picsval">
            <tr>
                <td height="80">文章图片</td>
                <td class="cpgl_cptj_sc">
                    <input type="file" id="images" class="input-xlarge" autofocus="true">
                    <p>最大100KB，支持jpg，gif，png格式。</p>
                    <div id="preview">
                        <?php if(!empty($this->vars['pics'])){?>
                            <?php foreach ($this->vars['pics'] as $key=>$pic){?>
                                <div style='width:100px;height:100px;float:left;position:relative;margin-right:10px;'><img style='width:100px;height:100px;' src="<?php echo DS.'uploads'.DS.$pic['savepath']?>">
                                    <span data-id="<?php echo $pic['id'];?>"  class="delete" style="display: block;width:15px;height:15px;background:rgba(0,0,0,0.5);position: absolute;right:0;top:0;text-align: center;line-height: 15px;color:white;cursor:pointer">
                                        ×
                                    </span>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td height="80">排序</td>
                <td><input name="sort" type="text" class="cpgl_cptj_mc"  value="<?php echo $this->vars['article']['sort'];?>" placeholder="数字越小越靠前"></td>
            </tr>
            <tr>
                <td height="80">文章详情</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td  colspan="2"><div class="dsjj_nr1">

                        <textarea name="content" id="detail" ><?php echo $this->vars['article']['content'];?></textarea>

                    </div></td>
            </tr>
            <tr>
                <td height="80" colspan="2"><div class="dsjj_nr_menu">
                        <input name="" type="submit" value="提交" />
                    </div></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>

<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/default/default.css" />
<script charset="utf-8" src="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/zh_CN.js"></script>
<script type="text/javascript">
    var editor_content;
    KindEditor.ready(function(K) {
        editor_content = K.create('textarea[name="content"]', {
            allowFileManager : false,
            themesPath: K.basePath,
            width: '100%',
            height: '450',
            resizeType: 1,
            pasteType : 2,
            urlType : 'absolute',
            fileManagerJson : '',
            uploadJson : '<?php echo url("File/uploadEdit");?>',
            extraFileUploadParams: {
            }
        });
    });

    $(function() {
        $('#images').uploadifive({
            'uploadScript': '<?php echo url("File/uploadPicture");?>',
            'auto': true,
            'buttonText': "",
            'uploadLimit': 3,
            'onUploadComplete': function (file, data, response) {
                var filedata = JSON.parse(data);
                var images = $("#picsval").val();
                if (images == "") {
                    var newimages = filedata.data.id;
                } else {
                    var newimages = images + "," + filedata.data.id;
                }
                if (filedata.status == 1) {
                    $("#preview").append("<div style='width:100px;height:100px;float:left;position:relative;margin-right:10px;'><img style='width:100px;height:100px;' src='" + filedata.data.ossres + "'><span data-id='"+filedata.data.id+"'  class='delete' style='display: block;width:15px;height:15px;background:rgba(0,0,0,0.5);position: absolute;right:0;top:0;text-align: center;line-height: 15px;color:white;cursor:pointer'>×</span></div>");
                    $("#preview").css("display", "block");
                    $("#picsval").val(newimages);
                } else {
                    alert(filedata.info);
                    return;
                }
            }
        })
    });
    /*页面点击事件*/
    $(document).on("click",".delete", function() {
        //先移除div，再删除pics隐藏input中的对应id内容
        var removeid=$(this).attr("data-id");
        $(this).parent().remove();
        var picval=$("#picsval").val();
        var picsarr=picval.split(",");
        var index = picsarr.indexOf(removeid);
        if (index > -1) {
            picsarr.splice(index, 1);
        }
        var newpicsval=picsarr.join(',');
        $("#picsval").val(newpicsval);
    });
</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

