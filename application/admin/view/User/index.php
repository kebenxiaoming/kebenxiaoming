<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
<style type="text/css">
    table tr{
        height:50px;
        text-align: left;
        border:1px solid white;
    }
</style>
<div class="btn-toolbar" style="margin-bottom:2px;">
    <a data-toggle="collapse" data-target="#search"  href="#" title= "检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>
<div class="block">
    <div id="page-stats" class="block-body collapse in">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_bt">
            <tr>
                <td width="60" height="60" align="center">#</td>
                <td width="111" align="center">用户名</td>
                <td width="111" align="center">真名</td>
                <td width="124" align="center">手机</td>
                <td width="109" align="center">登录时间</td>
                <td width="100" align="center">登录IP</td>
                <td width="100" align="center">Group#</td>
                <td width="100" align="center">操作</td>
            </tr>
        </table>
        <?php foreach ($this->vars['user_infos'] as $key=>$user_info){?>
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_nr">
            <tr>
                <td width="60" align="center"><?php echo $user_info['user_id'];?></td>
                <td width="111" align="center"><?php echo $user_info['user_name'];?></td>
                <td width="124" align="center"><?php echo $user_info['real_name'];?></td>
                <td width="100" align="center"><?php echo $user_info['mobile'];?></td>
                <td width="100" align="center"><?php echo date("Y-m-d",$user_info['login_time']);?></td>
                <td width="100" align="center"><?php echo $user_info['login_ip'];?></td>
                <td width="100" align="center"><?php echo $user_info['group_name'];?></td>
                <td width="100" align="center">
                    <a href="<?php echo url('User/edit',array('user_id'=>$user_info['user_id']))?>" title= "修改" >修改</a>
                    &nbsp;
                    <?php if($user_info['user_id'] == 1){}else{?>
                    <a data-toggle="modal" href="#myModal" title= "删除" >
                        <i class="icon-remove" goto="<?php echo url('User/del',array('user_id'=>$user_info['user_id']))?>" >删除</i></a>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?php } ?>
        <!--- START 分页模板 --->
        <?php $this->vars['page_html']?>

        <!--- END --->
    </div>
</div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>