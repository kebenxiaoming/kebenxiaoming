<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->
    <style type="text/css">
        .table {
            width:100%;
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
                    <th>#</th>
                    <th>模块名</th>
                    <th>模块链接</th>
                    <th>排序</th>
                    <th>是否在线</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->vars['modules'] as $key=>$module){?>
                <tr>
                    <td><?php echo $module['module_id'];?></td>
                    <td><?php echo $module['module_name'];?></td>
                    <td><?php echo $module['module_url'];?></td>
                    <td><?php echo $module['module_sort'];?></td>
                    <td>
                        <?php if($module['online'] ==1 ){?>
                        在线
                        <?php }else{ ?>
                        已下线
                        <?php } ?>
                    </td>
                    <td><?php echo $module['module_desc'];?></td>
                    <td>
                        <a href="<?php echo url('Module/edit',array('module_id'=>$module['module_id']));?>" title= "修改" >修改</a>
                        &nbsp;
                        <?php if($module['module_id'] != 1){?>
                        <a data-toggle="modal" href="#myModal"  title= "删除" ><i class="icon-remove" goto="<?php echo url('Module/delete',array('module_id'=>$module['module_id']));?>">删除</i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>