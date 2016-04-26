<?php
/**
 * Author:LNC
 * Description: 实名认证页面
 * Date: 2016/4/26 0026
 * Time: 下午 4:22
 */
$base_css_url = $this->config->item('base_css_url');
$base_js_url = $this->config->item('base_js_url');
$base_img_url = $this->config->item('base_img_url');
?>

<!DOCTYPE html>
<!-- saved from url=(0045)http://m-m10086.com/WEBFORM/SIM/verified.aspx -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name="format-detection" content="telephone=no"><title>
        实名认证
    </title><link href="<?php echo $base_css_url?>/main.css" rel="stylesheet"><link href="<?php echo $base_css_url?>/verified.css" rel="stylesheet">
    <script src="<?php echo $base_js_url?>/jquery.min.js"></script>
    <script src="<?php echo $base_js_url?>/jshelper.js"></script>
    <script src="<?php echo $base_js_url?>/toptip.js"></script>
    <script>
        $(function () {
            $(".verified-tj-btn").click(function () {
                if ($.trim($("#txtSim").val()) == "") {
                    $.showTip("流量卡号不能为空！");
                } else if ($.trim($("#txtMobile").val()) == "") {
                    $.showTip("手机号不能为空！");
                } else if ($.trim($("#txtIDCard").val()) == "") {
                    $.showTip("身份证号码不能为空！");
                } else if ($.trim($("#file1").val()) == "") {
                    $.showTip("身份证图片不能为空！");
                } else if ($.trim($("#file2").val()) == "") {
                    $.showTip("身份证图片不能为空！");
                } else {
                    document.getElementById("form1").submit();
                    //$(".verified-confirm-bg").show();
                    //$(".verified-confirm-container").show();
                }
            });


            $(".verified-close-btn").click(function () {
                $(".verified-confirm-bg").hide();
                $(".verified-confirm-container").hide();
            });

            $('#txtSim').blur(function () {
                var key = $("#txtSim").val();
                var params = { fun: 1, Key: key };
                $.ajax({
                    type: "get",
                    timeout: 1000,
                    url: "verified.aspx",
                    data: params
                }).done(function (data) {
                    var json = JSON.parse(data)
                    if (json.error == 0) {
                        $(".v-tips").hide();
                    } else {
                        $(".v-tips").show();
                    }

                })
            });

        })

        function showVtips() {
            $(".verified-confirm-bg").show();
            $(".verified-confirm-container").show();
        }
    </script>
</head>
<body>
<form method="post" action="#" id="form1" enctype="multipart/form-data">
    <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="">
    </div>

    <div id="divshowTip"><div style="width: 100%; height: 2.5em; font-size: 1.25em; line-height: 2.5em; text-align: center; color: rgb(255, 255, 255); text-shadow: rgb(0, 0, 0) 0px 0px 2px; position: fixed; z-index: 9999; transition: all 0.5s; opacity: 0; transform: translateY(-2em); background-color: rgb(219, 112, 147);">流量卡号不能为空！</div></div>
    <div class="veritied-part1">
        <p class="px16">尊敬的用户：</p>
        <p>为了贯彻工信部《电话用户真实身份信息登记规
            定》的规定，请对您购买的流量卡进行实名认证。</p>
    </div>
    <div class="veritied-part2">
        <h3 class="v-padding v-h3">请输入购买的流量卡号</h3>
        <input type="text" placeholder="请输入购买的流量卡号" class="verified-input card-input" on="" id="txtSim" name="txtSim">
        <span class="v-padding v-tips" style="display: none">该号码已认证</span>
    </div>
    <div class="veritied-part3">
        <h3 class="v-padding v-h3">输入认证信息</h3>
        <input type="text" placeholder="请输入手机号" class="verified-input tel-input" maxlength="11" pattern="[0-9]*" id="txtMobile" name="txtMobile">
        <input type="text" placeholder="请输入身份证号码" class="verified-input IDCard-input" maxlength="18" id="txtIDCard" name="txtIDCard">
    </div>
    <div class="veritied-part4">
        <h3 class="v-padding v-h3">请分别上传身份证正反面照片</h3>
        <div class="v-padding upload-photos">
            <input name="file1" type="file" id="file1" onchange="previewImage(this,&#39;img1&#39;)" style="display: none">
            <div class="l-upload" id="">
                <div class="upload-container" id="img1" onclick="document.getElementById(&#39;file1&#39;).click()"><span>上传身份证正面</span></div>
            </div>
            <input name="file2" type="file" id="file2" onchange="previewImage(this,&#39;img2&#39;)" style="display: none">
            <div class="r-upload">
                <div class="upload-container" id="img2" onclick="document.getElementById(&#39;file2&#39;).click()"><span>上传身份证反面</span></div>
            </div>
        </div>
    </div>

    <div class="veritied-part5 v-padding">
        <input type="button" value="提交认证" class="verified-btn verified-tj-btn">
    </div>

    <!--下发成功提示-->
    <div class="m-confirm-bg verified-confirm-bg"></div>
    <div class="m-confirm-container verified-confirm-container">
        <div class="v-confirm-txt">
            <p>您的认证信息已成功提交系统，工作人员会在24小时内完成审核，如有问题会及时与您联系！</p>
            <input type="button" value="关闭" class="verified-btn verified-close-btn">
        </div>
    </div>
</form>

<script type="text/javascript">
    function previewImage(file, prvid) { //fileid
        /* file：file控件
         * prvid: 图片预览容器
         */
        var tip = "Expect jpg or png or gif!"; // 设定提示信息
        var filters = {
            "jpeg": "/9j/4",
            "gif": "R0lGOD",
            "png": "iVBORw"
        }
        var prvbox = document.getElementById(prvid);
        // var file = document.getElementById(fileid);
        prvbox.innerHTML = "";
        if (window.FileReader) { // html5方案
            for (var i = 0, f; f = file.files[i]; i++) {
                var fr = new FileReader();
                fr.onload = function (e) {
                    var src = e.target.result;
                    if (!validateImg(src)) {
                        alert(tip)
                    } else {
                        showPrvImg(src);
                    }
                }
                fr.readAsDataURL(f);
            }
        } else { // 降级处理
            if (!/\.jpg$|\.png$|\.gif$/i.test(file.value)) {
                alert(tip);
            } else {
                showPrvImg(file.value);
            }
        }

        function validateImg(data) {
            var pos = data.indexOf(",") + 1;
            for (var e in filters) {
                if (data.indexOf(filters[e]) === pos) {
                    return e;
                }
            }
            return null;
        }

        function showPrvImg(src) {
            var img = document.createElement("img");
            img.src = src;
            prvbox.appendChild(img);
        }
    }
</script>


</body></html>
