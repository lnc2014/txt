<?php
/**
 * 流量卡查询页面
 * User: Administrator
 * Date: 2016/4/15 0015
 * Time: 下午 4:30
 */
$base_css_url = $this->config->item('base_css_url');
$base_js_url = $this->config->item('base_js_url');
$base_img_url = $this->config->item('base_img_url');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><title>
        流量卡信息
    </title><link href="<?php echo $base_css_url?>/main.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
        }

        .nav-title {
            line-height: 28px;
            height: 30px;
        }

        .so-input {
            height: 50px;
            line-height: 50px;
        }

        .side-line {
            margin: 5px 0 5px 0;
            width: 100%;
            height: 1px;
            background: #000000;
        }

        .content-container {
            float: left;
            padding-top: 0px;
            padding-bottom: 10px;
            width: 100%;
            background: #ffffff;
        }

        .col-lblfor, .col-text {
            float: left;
            height: 30px;
            line-height: 30px;
            text-align: left;
        }

        .col-lblfor {
            width: 30%;
        }

        .col-text {
            width: 70%;
        }

        .col-none {
            width: 100%;
            height: 30px;
            line-height: 30px;
            color: red;
        }

        .fl-clear {
            float: left;
            width: 100%;
            height: 35px;
        }

        .fl-sublay {
            float: left;
            width: 100%;
            line-height: 50px;
        }
        /*记住号码css样式*/
        ul.rem-sim-num {
            margin-top: 0;
            list-style: none;
            padding-left: 0;
            background: #fff;
            line-height: 14px;
            border: 1px solid #ccc;
            color: #555;
            position: absolute;
            width: 100%;
            display: none;
        }

        ul.rem-sim-num li {
            text-indent: 0.5em;
            padding: 7px 0 7px 0;
            cursor: pointer;
        }

        ul.rem-sim-num li:hover {
            background: #F1F1F1;
        }

        ul.rem-sim-num li a {
            color: #555;
            text-decoration: none;
        }

        .m-control-scanning {
            display: block;
            position: absolute;
            top: 2px;
            right: 0;
        }

        .m-control-scanning img {
            height: 32px;
        }
        .scan-btn button{background-color:#fff;border:1px solid rgb(34, 169, 237);color:rgb(34, 169, 237);}
        .simsearch-dec{text-align:center;}
        .simsearch-txt{padding-left:30px;background:url(../images/terminal/txt-img.png) 0 0 no-repeat;box-sizing: border-box;}
        /* 移动端媒体查询像素比 */
        @media only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (min-device-pixel-ratio: 2) {
            .simsearch-txt{background-image:url(../images/terminal/txt-img@2x.png);background-size:30px auto;}
        }
    </style>
</head>

<body>
<div id="divshowTip"><div></div></div>
<div class="m-vertical-space-sm"></div>

<div class="m-container">
    <div class="nav-title"></div>
    <div class="so-input" style="position: relative;">
        <input name="txtSearchKey" type="text" id="txtSearchKey" class="m-control-input simsearch-txt" placeholder="请输入ICCID号或流量卡号">

        <ul class="rem-sim-num"></ul>
    </div>

    <div class="so-input">
        <button id="btnSearch" class="m-btn m-btn-info m-btn-block">查询</button>
    </div>
    <div class="so-input scan-btn">
        <button id="AscanQRCode" class="m-btn m-btn-block">扫码输入</button>
    </div>
</div>

<div class="m-vertical-space-sm"></div>

<div class="content-container">
    <span style="margin-left: 20px">温馨提示：系统自动记住您最近查询成功的号码</span>
</div>
<div class="m-container simsearch-dec">
    <img src="<?php echo $base_img_url?>/simsearch-img@2x.png" width="268">
    <p>点击“扫码输入”，对着卡的条形码扫一扫</p>
</div>
<div style="display: none; margin-left: 20px; color: red;" id="divCheckSIM"></div>
<input type="hidden" id="hid_WeChatId" value="oyVv8s3yjFbXo7ksQoXBDaa6V8s4">
<script src="<?php echo $base_js_url ?>/jquery.min.js"></script>
<script src="<?php echo $base_js_url ?>/jshelper.js"></script>
<script src="<?php echo $base_js_url ?>/jquery.cookie.js"></script>
<script src="<?php echo $base_js_url ?>/toptip.min.js"></script>

<script>
    $(function(){
        $("#btnSearch").click(function () {


            var key = $.trim($("#txtSearchKey").val());
            if (key) {
                var num = isNaN(key);

                if(num){
                    $.showTip("输入的流量卡号不正确，请输入数字！");
                    return;
                }
                $.ajax({
                    type:"POST",
                    //提交的网址
                    url:'<?php echo site_url('wechat/use_api')?>',
                    //提交的数据
                    data:{
                        iccid : key,
                    },
                    //返回数据的格式
                    datatype: "json",
                    success:function(data){

                        if(data == 104){//商品序列号不存在

                            $("#divCheckSIM").show();
                            $("#divCheckSIM").html("查不到" + $.trim($("#txtSearchKey").val()) + "相关数据");

                        }else if(data == 100){
                            var iccid = '?iccid='+key;

                            var taocan_url = '<?php echo site_url('wechat/taocan_detail')?>'+iccid;
                            console.log(taocan_url);
                            window.location.href = taocan_url;
                        }

                    }   ,
                    //调用执行后调用的函数
                    complete: function(XMLHttpRequest, textStatus){

                    },
                    //调用出错执行的函数
                    error: function(){
                        //请求出错处理
                        alert('程序出错！');
                    }
                });

            } else {
                $.showTip("请输入要查询的流量卡号");
            }


        });
    });


</script>
</body>
</html>
