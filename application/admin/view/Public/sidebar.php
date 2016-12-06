<div id="left">
    <div class="left_tb"><img src="<?php echo config('PUBLIC');?>/Admin/images/sy_07.jpg" width="248" height="154" /></div>
    <div class="left_nr">
        <div class="sideMenu">
            <ul>
                <?php foreach($this->vars['sidebar'] as $key=>$module){
                    if(count($module['menu_list'])>0)
                    {
                        if($module['module_id']==$this->vars['current_module_id']){
                ?>
                <li class="nLi on">
                    <h3 style="background-color:#541b86"><?php if(isset($module['module_name'])){echo $module['module_name'];}else{echo "";}?></h3>
                    <ul class="sub">
                     <?php }else{ ?>
                     <li class="nLi">
                     <h3><?php if(isset($module['module_name'])){echo $module['module_name'];}else{echo "";}?></h3>
                     <ul class="sub">
                     <?php } ?>
                         <?php foreach($module['menu_list'] as $k=>$menu_list){ ?>
                                <?php if(strtolower(substr($menu_list['menu_url'],0,4)) == 'http'){?>
                                <?php if($menu_list['menu_id']==$this->vars['content_header']['menu_id']){?>
                                <li style="background-color:#412a54"><a target=_blank href="<?php echo url($menu_list['menu_url']);?>"><?php echo $menu_list['menu_name'];?></a></li>
                                <?php }else{ ?>
                                <li><a target=_blank href="<?php echo url($menu_list['menu_url']);?>"><?php echo $menu_list['menu_name'];?></a></li>
                                <?php } ?>
                                <?php }else{ ?>
                                <?php if($menu_list['menu_id'] == $this->vars['content_header']['menu_id']){ ?>
                                <li style="background-color:#412a54"><a href="<?php echo url($menu_list['menu_url']);?>"><?php echo $menu_list['menu_name'];?></a></li>
                                 <?php }else{ ?>
                                <li><a href="<?php echo url($menu_list['menu_url']);?>"><?php echo $menu_list['menu_name'];?></a></li>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
        </div>
    </div>
</div>
<!--- 以上为左侧菜单栏 sidebar --->

<div id="right">
    <div class="right_nr">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="right_nr_bt">
            <tr>
                <td width="151" height="50" align="center" style="background-color:#541b86"><?php if(isset($this->vars['content_header']['menu_name'])){echo $this->vars['content_header']['menu_name'];}else{echo "";}?></td>
                <td width="574">
                    <?php if($this->vars['content_header']['menu_id'] == 11){ ?>
                </td>
                <td width="130"><div class="cp_xz"><a href="<?php echo url('Module/add');?>">添加模块</a></div></td>
                <?php }elseif($this->vars['content_header']['menu_id'] == 2){ ?>
                </td>
                <td width="130"><div class="cp_xz"><a href="<?php echo url('User/add');?>">添加用户</a></div></td>
                <?php }elseif($this->vars['content_header']['menu_id'] == 14){ ?>
                </td>
                <td width="130"><div class="cp_xz"><a href="<?php echo url('Menu/add');?>">添加菜单</a></div></td>
                <?php }elseif($this->vars['content_header']['menu_id'] == 24){ ?>
                    </td>
                    <td width="130"><div class="cp_xz"><a href="<?php echo url('Blog/add');?>">添加博客</a></div></td>
                <?php }elseif($this->vars['content_header']['menu_id'] == 7){ ?>
                </td>
                <td width="130"><div class="cp_xz"><a href="<?php echo url('Group/add');?>">添加账号组</a></div></td>
                <?php } ?>
            </tr>
        </table>