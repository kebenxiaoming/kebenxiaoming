<?php
require dirname(dirname(__FILE__))."/Public/simple_header.php";
?>
<body>
<div class="login1"></div>
<div class="login2">
    <div class="login2_nr">
        <form name="loginForm" method="post" action="">
            <table width="356" border="0" cellspacing="0" cellpadding="0" class="login2_nr_xx">
                <tr>
                    <td height="62" colspan="2" valign="top"><input type="text" name="user_name" value="<?php echo input('post.user_name');?>" id="textfield1" placeholder="Username" class="login2_nr_sr"></td>
                </tr>
                <tr>
                    <td height="61" colspan="2" valign="top"><input type="password" name="password" id="textfield2" value = "<?php echo input('post.password');?>" placeholder="Password" class="login2_nr_sr"></td>
                </tr>
                <tr>
                    <td width="177" height="53" valign="top"><input type="text" name="verify_code" id="textfield" placeholder="不用输" class="login2_nr_yz"></td>
                    <td width="240" valign="top"></td>
                </tr>
                <tr>
                    <td height="58" valign="top"><input type="checkbox" name="remember" value="remember-me" id="checkbox"  class="login2_nr_xz"></td>
                    <td align="right" valign="top"><input name="loginSubmit" type="submit" value="登 录"   class="login2_nr_dl"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="login3"> Copyright © 2005 - 2016  Sunny.All Rights Reserved.<br />
    sunny 版权所有</div>
</body>
<script type="text/javascript">
    $("#verify_code").click(function(){
        $(this).attr("src","<?php echo url('Login/verify');?>&rr="+Math.random());
    });
</script>
</html>


