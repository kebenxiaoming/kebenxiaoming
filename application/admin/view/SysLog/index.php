<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
    <div class="wzgl_czjl">
        <?php foreach ($this->vars['logs'] as $key=>$sys_log){ ?>
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="wzgl_czjl_lb">
            <tr>
                <td width="16" height="40"><img src="<?php echo config('PUBLIC');?>/Admin/images/dian_03.jpg" width="5" height="5" /></td>
                <td width="104" style="color:#900"><?php echo $sys_log['user_name'];?></td>
                <td width="549" ><?php echo $sys_log['record'];?></td>
                <td width="186" align="right" style="color:#666"><?php echo date("Y-m-d H:i:s",$sys_log['op_time']);?></td>
            </tr>
        </table>
        <?php } ?>
        <div class="intro_cxcp_nr_fy"><?php  if(isset($this->vars['page_html'])){echo $this->vars['page_html'];} ?></div>
    </div>
    </div>
    </div>
    <!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>