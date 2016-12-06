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
                <td><input name="title" type="text" class="cpgl_cptj_mc" value="{$_POST.title}" required="true"></td>
            </tr>
            <tr>
                <td width="106" height="80">所属分类菜单</td>
                <td width="749"><div class="cpgl_cptj_xl">
                        <select name="cat_id" style="margin:5px 0px 0px">
                            <volist name="categories" id="category">
                                <option value="{$category.id}">{$category.name}</option>
                            </volist>
                        </select>
                    </div></td>
            </tr>
            <tr>
                <td height="200">简介</td>
                <td><textarea name="desc" type="text" class="cpgl_cptj_mc" required="true"  style="width:400px;height:200px;" >{$news.desc}</textarea></td>
            </tr>
            <if condition="$has_pics">
                <tr>
                    <td height="80">副标题</td>
                    <td><input name="alias" type="text" class="cpgl_cptj_mc" value="{$_POST.alias}" placeholder="填写英文" required="true"></td>
                </tr>
                <input type="hidden" value="{$_POST.pics}" name="pics" id="picsval">
                <tr>
                    <td height="80">文章图片</td>
                    <td class="cpgl_cptj_sc">
                        <input type="file" id="images" class="input-xlarge" autofocus="true">
                        <p>最大100KB，支持jpg，gif，png格式。</p>
                        <div id="preview"></div>
                    </td>
                </tr>
            </if>
            <tr>
                <td height="80">作者</td>
                <td><input name="author" type="text" class="cpgl_cptj_mc" value="{$_POST.author}"></td>
            </tr>
            <tr>
                <td height="80">排序</td>
                <td><input name="sort" type="text" class="cpgl_cptj_mc"  value="{$_POST.sort}" placeholder="数字越小越靠前"></td>
            </tr>
            <tr>
                <td height="80">文章详情</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td  colspan="2"><div class="dsjj_nr1">

                        <textarea name="content" id="detail" >{$_POST.content}</textarea>

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
            uploadJson : '{:U("File/uploadEdit")}',
            extraFileUploadParams: {
            }
        });
    });

    $(function() {
        $('#images').uploadifive({
            'uploadScript': '{:U("File/uploadPicture")}',
            'auto': true,
            'buttonText': "",
            'uploadLimit': 3,
            'onUploadComplete': function (file, data, response) {
                var filedata = JSON.parse(data);
                var images = $("#picsval").val();
                if (images == "") {
                    var newimages = filedata.data.Filedata.id;
                } else {
                    var newimages = images + "," + filedata.data.Filedata.id;
                }
                if (filedata.status == 1) {
                    $("#preview").append("<div style='width:100px;height:100px;float:left;'><img style='width:100px;height:100px;' src='" + filedata.data.Filedata.ossres + "'></div>");
                    $("#preview").css("display", "block");
                    $("#picsval").val(newimages);
                } else {
                    alert(filedata.info);
                    return;
                }
            }
        })
    });
</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

