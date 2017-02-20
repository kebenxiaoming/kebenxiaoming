<?php
/**
 * Created by sunny.
 * User: sunny
 * Have a nice day!
 * Date: 2017/2/13
 * Time: 15:53
 */

echo file_get_contents("http://techpassport.tuhu.cn/OAuth/UserInfo?token=77022168983311F957BE107AF1B2EF89A7D9DAE7");
die;
$code ='<<<PHP_CODE
<?php
$str = "Hello, Tipi\n";
echo $str;
PHP_CODE';

var_dump(token_get_all($code));