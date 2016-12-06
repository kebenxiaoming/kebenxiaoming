<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
<table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_bt">
    <tr>
        <td width="50" height="60" align="center">ID</td>
        <td width="251" align="center">标题</td>
        <td width="200" align="center">创建时间</td>
        <td width="136" align="center">文章排序</td>
        <td width="139" align="center">操作</td>
    </tr>
</table>
<?php if(isset($this->vars['news'])){foreach($this->vars['news'] as $key=>$new){?>
    <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_nr">
        <tr>
            <td width="50" height="48" align="center"><?php echo $new['id'];?></td>
            <td width="251" align="center"><?php echo $new['title'];?></td>
            <td width="200" align="center"><?php echo date('Y-m-d H:i:s',$new['create_time']);?></td>
            <td width="136" align="center"><input type="text" value="<?php echo $new['sort'];?>" class="listorder" data-id="<?php echo $new['id'];?>"/></td>
            <td width="139" align="center"><a href="<?php echo url('Blog/edit',array('id'=>$new['id']));?>"><img src="<?php echo config('PUBLIC');?>/Admin/images/cp_11.jpg" width="27" height="27" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a goto="<?php echo url('Blog/del',array('id'=>$new['id']));?>" class="icon-remove"><img src="<?php echo config('PUBLIC');?>/Admin/images/cp_13.jpg" width="27" height="27" /></a></td>
        </tr>
    </table>
<?php }} ?>
<div class="intro_cxcp_nr_fy"><?php if(isset($this->vars['page_html'])){echo $this->vars['page_html'];}?></div>
</div>
</div>
</div>
<script>
    var oldorder=0;
    $(".listorder").focus(function(){
        oldorder = $(this).val();
        if(isNaN(parseInt(neworder))){
            alert("请输入正确的数字！");
            oldorder=0;
            return;
        }
    });
    $(".listorder").blur(function(){
        var neworder=$(this).val();
        if(isNaN(parseInt(neworder))){
            alert("请输入正确的数字！");
            return;
        }
        if(oldorder==neworder){
            return;
        }
        var newsid=$(this).data("id");
        $.post("{:U('News/listorder')}",{newsid:newsid,sort:neworder},function(data){
            if(data.status==0){
                alert(data.msg);
            }
        });
    });
</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

