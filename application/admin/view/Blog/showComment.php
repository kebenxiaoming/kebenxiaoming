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
                <td height="80">博客标题</td>
                <td><input name="title" type="text" class="cpgl_cptj_mc" value="<?php echo $this->vars['comment']['title'];?>" required="true"></td>
            </tr>
            <tr>
                <td height="200">简介</td>
                <td><textarea name="description" type="text" class="cpgl_cptj_mc" required="true"  style="width:400px;height:200px;" ><?php echo $this->vars['comment']['content'];?></textarea></td>
            </tr>

            <tr>
                <td height="80">创建时间</td>
                <td><input name="sort" type="text" class="cpgl_cptj_mc"  value="<?php echo date("Y-m-d H:i:s",$this->vars['comment']['create_time']);?>"></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

