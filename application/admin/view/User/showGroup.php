<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <div class="block">
        <div id="page-stats" class="block-body collapse in">
            <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_bt">
                <tr>
                    <td style="width:20px">#</td>
                    <td style="width:80px">登录名</td>
                    <td style="width:100px">姓名</td>
                    <td style="width:100px">手机</td>
                    <td style="width:80px">邮箱</td>
                    <td style="width:80px">登录时间</td>
                    <td style="width:80px">登录IP</td>
                    <td style="width:80px">描述</td>
                </tr>
            </table>
            <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cplb_nr">
                <?php if(isset($this->vars['user_infos'])){foreach($this->vars['user_infos'] as $key=>$user_info){?>
                <tr>
                    <td><?php echo $user_info['user_id'];?></td>
                    <td><?php echo $user_info['user_name'];?></td>
                    <td><?php echo $user_info['real_name'];?></td>
                    <td><?php echo $user_info['mobile'];?></td>
                    <td><?php echo $user_info['email'];?></td>
                    <td><?php echo $user_info['login_time'];?></td>
                    <td><?php echo $user_info['login_ip'];?></td>
                    <td><?php echo $user_info['user_desc'];?></td>
                    <td>
                        <a href="user_modify.php?user_id={$user_info.user_id}" title= "修改" ><i class="icon-pencil"></i></a>
                        &nbsp;
                        <?php if($user_info['status'] != 1){?>
                        <a data-toggle="modal" href="#myModal"  title= "封停账号" ><i class="icon-pause" href="users.php?page_no={$Request.get.page}&method=pause&user_id={$user_info.user_id}"></i></a>
                        <?php } ?>
                        <?php if($user_info['status'] == 0){?>
                        <a data-toggle="modal" href="#myModal" title= "解封账号" ><i class="icon-play" href="users.php?page_no={$Request.get.page}&method=play&user_id={$user_info.user_id}"></i></a>
                        <?php } ?>
                        &nbsp;
                        <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="users.php?page_no={$Request.get.page}&method=del&user_id={$user_info.user_id}" ></i></a>
                    </td>
                </tr>
                <?php } } ?>
            </table>
            <!--- START 分页模板 --->
           <?php if(isset($this->vars['page_html'])){echo $this->vars['page_html'];}?>

            <!--- END --->
        </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>