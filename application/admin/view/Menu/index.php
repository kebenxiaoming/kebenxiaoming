<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <style type="text/css">
        .table {
            border-collapse: collapse;
            font-family:'Microsoft YaHei';
        }
        .table thead{
            background-color:#505050;
            color:white;
        }
        .table thead tr{
            border: 1px solid white;
            height:50px;
            text-align: center;
        }
        .table tbody{
            background-color: #f4f4f4;
        }
        .table tbody tr{
            height:30px;
        }
        .table tbody tr{
            height:50px;
            text-align: left;
            border:1px solid white;
        }
    </style>

    <div class="block">
        <div id="page-stats" class="block-body collapse in">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:30px">#</th>
                    <th style="width:90px">名称</th>
                    <th style="width:180px">URL</th>
                    <th style="width:80px">所属模块</th>
                    <th style="width:80px">菜单</th>
                    <th style="width:80px">所属菜单</th>
                    <th style="width:80px">是否在线</th>
                    <th style="width:80px">快捷菜单</th>
                    <th style="width:180px">描述</th>
                    <th style="width:80px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->vars['menus'] as $key=>$menu){?>
                <tr>
                    <td><?php echo $menu['menu_id'];?></td>
                    <td><?php echo $menu['menu_name'];?></td>
                    <td><?php echo $menu['menu_url'];?></td>
                    <td>
                        <?php if(isset($this->vars['module_options_list'][$menu['module_id']])){echo $this->vars['module_options_list'][$menu['module_id']];}?></td>
                    <td>
                        <?php if($menu['is_show']){?>
                        是
                        <?php }else{ ?>
                        否
                        <?php } ?>
                    </td>
                    <td><?php if($menu['father_menu'] > 0){echo getMenuName($menu['father_menu']);}?></td>

                    <td>
                        <?php if($menu['online']){?>
                        在线
                        <?php }else{ ?>
                        已下线
                       <?php } ?></td>
                    <td>
                        <?php if($menu['shortcut_allowed']){?>
                        允许
                        <?php }else{ ?>
                        不允许
                        <?php } ?>
                    </td>
                    <td><?php echo $menu['menu_desc'];?></td>

                    <td>
                        <a href="<?php echo url('Menu/edit',array('menu_id'=>$menu['menu_id']));?>" title= "修改" ><i class="icon-pencil">修改</i></a>
                            <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" goto="<?php echo url('Menu/del',array('menu_id'=>$menu['menu_id']));?>" >删除</i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <!--- START 分页模板 --->
            <div class="intro_cxcp_nr_fy"> <div><?php if(isset($this->vars['page_html'])){echo $this->vars['page_html'];}?></div></div>
            <!--- END 分页--->
        </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>