<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <style>
        .thisform{
            margin:20px 0px;
            font-size:20px;
        }
        .thisform li{
            margin:10px 0px;
            list-style : none;
            height:50px;
        }
        .thisform li .wz_qxgl_xl{
            float:left;
            margin:0px;
        }
        .thisform li label{
            margin-right:20px;
            display:block;
            float:left;
        }
        .label  {
            font-size:1px;
            color:red;
        }
    </style>

    <div class="well">

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane active in" id="home">

                <form id="tab" method="post" action="">
                    <ul class="thisform">
                        <li>
                            <label>名称</label>
                            <input type="text" name="menu_name" value="<?php echo $this->vars['currentmenu']['menu_name'];?>" class="input-xlarge right_nr_zhzgl_sr" required="true" autofocus="true">
                        </li>
                        <li>
                            <label>链接 <span class="label label-important">不可重复，以/开头的相对路径或者http网址</span></label>
                            <input type="text" name="menu_url" value="<?php echo $this->vars['currentmenu']['menu_url'];?>" class="input-xlarge right_nr_zhzgl_sr" placeholder="Index/index"  required="true" >
                        </li>
                        <li>
                            <label>所属模块</label>
                            <div class="wz_qxgl_xl">
                                <select name="module_id" class="input-xlarge" id="DropDownTimezone">
                                    <?php
                                    foreach($this->vars['module_options_list'] as $k=>$val){
                                        if($this->vars['currentmenu']['module_id']==$k){
                                            echo "<option value='".$k."' class='input-xlarge option' id='DropDownTimezone-1' selected='selected'>".$val."</option>";
                                        }else{
                                            echo "<option value='".$k."' class='input-xlarge option' id='DropDownTimezone-1'>".$val."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>是否显示为左侧菜单</label>
                            <div class="wz_qxgl_xl">
                                <select name="is_show" class="input-xlarge" >
                                    <?php if($this->vars['currentmenu']['is_show']){ ?>
                                    <option value="1" selected >是</option>
                                    <option value="0">否</option>
                                    <?php }else{ ?>
                                    <option value="1"  >是</option>
                                    <option value="0" selected>否</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>所属菜单</label>
                            <div class="wz_qxgl_xl">
                                <select name="father_menu" class="input-xlarge" id="DropDownTimezone">
                                    <?php
                                    foreach($this->vars['father_menu_options_list'] as $k=>$val){
                                        if(is_array($val)){
                                            echo '<optgroup label="'.$k.'">';
                                            foreach($val as $key=>$v){
                                                if($this->vars['currentmenu']['father_menu']==$key){
                                                    echo '<option value="'.$key.'" selected="selected" class="input-xlarge option" id="DropDownTimezone-1-0">'.$v.'</option>';
                                                }else{
                                                    echo '<option value="'.$key.'" class="input-xlarge option" id="DropDownTimezone-1-0">'.$v.'</option>';
                                                }
                                            }
                                            echo '</optgroup>';
                                        }else{
                                            if($this->vars['currentmenu']['father_menu']==0){
                                                echo '<option value="'.$k.'" selected="selected" class="input-xlarge option" id="DropDownTimezone-0">'.$val.'</option>';
                                            }else{
                                                echo '<option value="'.$k.'" class="input-xlarge option" id="DropDownTimezone-0">'.$val.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>排序 <span class="label label-important">填写数字</span></label>
                            <input type="text" name="sort" value="<?php echo $this->vars['currentmenu']['sort'];?>" class="input-xlarge right_nr_zhzgl_sr" placeholder="越大越靠前，默认0"  required="true" >
                        </li>
                        <li style="height:220px;">
                            <label>描述</label>
                            <textarea name="menu_desc" rows="3" class="input-xlarge right_nr_zhzgl_xl"><?php echo $this->vars['currentmenu']['menu_desc'];?></textarea>
                        </li>
                        <li >
                            <div class="dsjj_nr_menu">
                                <input name="" type="submit" value="提交">
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>