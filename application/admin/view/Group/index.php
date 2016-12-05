<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <div class="cpgl_cplb">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_bt">
            <tr>
                <td width="265" height="60" align="center">#</td>
                <td width="151" align="center">账号组名</td>
                <td width="164" align="center">所有者</td>
                <td width="136" align="center">描述</td>
                <td width="139" align="center">操作</td>
            </tr>
        </table>
        <?php foreach($this->vars['groups'] as $key=>$group){?>
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_nr">
            <tr>
                <td width="265" height="48" align="center"><?php echo $group['group_id'];?></td>
                <td width="151" align="center"><?php echo $group['group_name'];?></td>
                <td width="164" align="center"><?php echo $group['owner_name'];?></td>
                <td width="136" align="center"><?php echo $group['group_desc'];?></td>
                <td width="139" align="center"><a href="<?php echo url("User/showGroup",array('group_id'=>$group['group_id']));?>"><img src="<?php echo config('PUBLIC');?>/Admin/images/zxj.jpg" width="31" height="27" /></a>&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo url("Group/edit",array('group_id'=>$group['group_id']));?>"><img src="<?php echo config('PUBLIC');?>/Admin/images/cp_11.jpg" width="27" height="27" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a goto="<?php echo url("Group/del",array('group_id'=>$group['group_id']));?>" class="icon-remove"><img src="<?php echo config('PUBLIC');?>/Admin/images/cp_13.jpg" width="27" height="27" /></a></td>
            </tr>
        </table>
        <?php } ?>
        <div class="intro_cxcp_nr_fy"><?php echo $this->vars['page_html'];?></div>
    </div>
    </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>