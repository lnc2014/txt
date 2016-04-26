<?php
/**
 * Description：运营商登录页面
 * Author: LNC
 * Date: 2016/4/24
 * Time: 22:53
 */
$base_css_url = $this->config->item('base_css_url');
$base_js_url = $this->config->item('base_js_url');
$base_img_url = $this->config->item('base_img_url');

?>
<!DOCTYPE html>
<!-- saved from url=(0049)http://open.m-m10010.com/Html/Operator/login.aspx -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><title>
        运营商登录
    </title><link href="<?php echo $base_css_url?>/main.css" rel="stylesheet"><link href="<?php echo $base_css_url?>/login.css" rel="stylesheet">
    <script src="<?php echo $base_js_url?>/jquery.min.js"></script>
    <script src="<?php echo $base_js_url?>/jshelper.js"></script>
    <script src="<?php echo $base_js_url?>/toptip.js"></script>
    <script>
        $(function () {

            $(".login-btn").click(function () {
                if ($.trim($(".inpUser").val()) == "") {
                    $.showTip("账号不能为空！");
                } else if ($.trim($(".inpPsw").val()) == "") {
                    $.showTip("密码不能为空！");
                } else {
                    document.getElementById("login").submit();
                }
            });


        })

        function alertEx(text) {
            $.showTip(text);
        }
    </script>
</head>
<body>
<form method="post" action="" id="login">


    <div id="divshowTip"><div></div></div>
    <div class="op-login-main">
        <ul>
            <li><input name="txtUserName" type="text" id="txtUserName" placeholder="请输入登录账号" class="inpTxt inpUser"></li>
            <li><input name="txtPassword" type="password" id="txtPassword" placeholder="请输入登录密码" class="inpTxt inpPsw"></li>
        </ul>
    </div>
    <div class="op-login-footer"><a href="#" class="login-btn">登录</a></div>
    <input name="hid_WechatId" type="hidden" id="hid_WechatId">
</form>




</body></html>
