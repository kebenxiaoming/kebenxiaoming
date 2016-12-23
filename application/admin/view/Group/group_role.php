<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>

<div class="wz_qxgl_xl">
    <select name="group_id" onchange="javascript:location.replace('<?php echo url('Group/group_role')?>&group_id='+this.options[this.selectedIndex].value)" style="margin:5px 0px 0px">
        <?php
        $group_id="";
        if(isset($_GET['group_id'])){
        $group_id=$_GET['group_id'];
        }
        foreach($this->vars['group_option_list'] as $key=>$v){
        if($key==$group_id){
        echo '<option value="'.$key.'" selected>'.$v.'</option>';
        }else{
        echo '<option value="'.$key.'">'.$v.'</option>';
        }
        }
        ?>
    </select>
</div>
<form method="post" action="">
    <div class="wz_qxgl_nr">
        <?php foreach($this->vars['role_list'] as $key=>$role){ ?>
        <?php if(!empty($role['menu_info'])){if(count($role['menu_info']) > 0){?>
        <table width="399" border="0" cellspacing="0" cellpadding="0" class="wz_qxgl_nr_xx">
            <tr>
                <td height="50" colspan="3" valign="top"><div class="wz_qxgl_nr_xx_bt"><?php echo $role['module_name'];?></div></td>
            </tr>
            <tr id="page-stats_<?php echo $role['module_id'];?>" class="block-body collapse in">
                <td width="133" height="40">
                    <?php
                    foreach($role['menu_info'] as $k=>$val){
                    if(in_array($k,$this->vars['group_role'])){
                    echo '<label style="display: inline-block;font-size: 12px;width: 180px"><input type="checkbox" name="menu_ids[]" value="'.$k.'" checked="checked">'.$val.'</label>&nbsp;&nbsp;';
                    }else{
                    echo '<label style="display: inline-block;font-size: 12px;width: 180px"><input type="checkbox" name="menu_ids[]" value="'.$k.'" >'.$val.'</label>&nbsp;&nbsp;';
                    }
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php }} ?>
        <?php } ?>
    </div>

    <div class="wz_qxgl_menu">
        <input name="" type="submit" value="确定" />
    </div>
</form>
</div>
</div>

    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>