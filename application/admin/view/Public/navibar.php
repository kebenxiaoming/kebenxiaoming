
<div id="header">
    <table width="1200" border="0" cellspacing="0" cellpadding="0" class="header_nr">
        <tr>
            <td height="69"><img src="<?php echo config('PUBLIC');?>/Admin/images/sy_03.jpg" width="53" height="23" /><a href="/public/admin">首页</a></td>
            <?php if(!empty($user_info)){?><td align="right">欢迎，<a href="<?php echo url('User/edit',array('user_id'=>$user_info['user_id']));?>"><?php echo $user_info['user_name']?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url('Login/logout');?>">退出</a></td><?php } ?>
        </tr>
    </table>
</div>

<div id="main">