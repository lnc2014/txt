<?php
/**
 * Description:套餐查询详细页面
 * Author: LNC
 * Date: 2016/4/17
 * Time: 22:41
 */
$base_css_url = $this->config->item('base_css_url');
$base_js_url = $this->config->item('base_js_url');
$base_img_url = $this->config->item('base_img_url');
?>

<!DOCTYPE html>
<!-- saved from url=(0127)http://open.m-m10010.com/Html/Terminal/simcard_lt.aspx?simNo=861064615266003&apptype=null&wechatId=oyVv8s3yjFbXo7ksQoXBDaa6V8s4 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><title>
        联通物联网卡
    </title><link href="<?php echo $base_css_url?>/main.css" rel="stylesheet"><link href="<?php echo $base_css_url?>/terminal.css" rel="stylesheet">
    <style>
        .u-simcard header .head-r .simcard-num{margin-bottom:0;display:none;}
        .u-simcard header .head-r p{padding-bottom:10px;}
        .u-simcard header .head-r p:last-of-type{padding-bottom:0px;}
        .u-simcard header .head-r p.simcard-iccid{color:#333;font-size:14px;}
        .simcard-package{text-align:left;margin-top:10px;color:#999;clear:both;line-height:20px;}
        .txt-red{color:red;font-weight:bold;}
        .simcard-package ul,li{list-style-type:disc;list-style-position: inside;}
        .dueTips{text-align:left;margin-bottom:10px;color:#999;}
        .monthFlowTips,.packageTips,.totalFlowTips{display:none;}
        footer{background-color:#fff;padding:10px 0px;position:fixed;left:0;bottom:0;width:100%;box-sizing:border-box;}
        #u-bottom ul li{float:left;width:50%;box-sizing:border-box;color:#536d75;padding:0 10px;list-style-type:none;}
        #u-bottom ul li:first-of-type{border-right:1px solid #536d75;text-align:right;}
        #u-bottom ul li:last-of-type{text-align:left;}
        .liContainer{width:110px;text-align:left;overflow:auto;line-height:20px;}
        #u-bottom ul li:first-of-type .liContainer{float:right;}
        #u-bottom ul li:last-of-type .liContainer{float:left;}
        .footer-icon{width:20px;height:20px;background-image:url(../images/terminal/icon.png);display:block;float:left;margin-right:5px;}
        .renewalIcon{background-position:0 0;}
        .amountIcon{background-position:-20px 0;}
        /*刷新样式*/
        .scroller .loadings{height: 40px;line-height: 40px;text-align: center;width: 100%;background-color: #f1f1f1;}
        .scroller{-webkit-overflow-scrolling:touch;}
        @media(max-width:350px){
            .u-simcard header .head-r p.simcard-iccid{font-size:13px;}
            .u-simcard header .head-r p{padding-bottom:5px;}
        }
        /* 移动端媒体查询像素比 */
        @media only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (min-device-pixel-ratio: 2) {
            .footer-icon{background-image:url(../images/terminal/icon@2x.png);background-size:40px auto;}
            .renewalIcon{background-position:0 0;}
            .amountIcon{background-position:-20px 0;}
        }
    </style>
</head>
<body>
<div id="divshowTip"><div></div></div>
<div id="refreshDiv" class="u-simcard scroller" style="transform: translate3d(0px, -40px, 0px);">
    <div class="loadings">
        <!-- 下拉刷新数据 -->
    </div>
    <header id="u-top">
        <div class="head-l">
            <img src="<?php echo $base_img_url ?>/liantong.png">
            <p>联通物联网卡</p>
        </div>
        <div class="head-r">
            <div class="simcard-num"><span>861064615266003</span></div>
            <p class="simcard-iccid">ICCID:<span>8986061501000710323</span></p>
            <p>流量套餐:<span id="lblPackageName"><?php echo $taocan['iratePlanName'] ?></span></p>
            <p><span id="lblPackageInfo"><?php echo $taocan['iratePlanName'] ?></span></p>
        </div>
        <!-- 切换卡号图标 -->
        <a class="changeCard" href="<?php echo site_url('wechat/check') ?>"></a>
    </header>
    <div class="simcard-main">
        <div class="dueTips"></div>
        <div class="simcard-circle circle-bg-10" style="color: rgb(255, 255, 255);">
            <p class="marTop">当月剩余流量(MB)</p><!-- 是否清零套餐 -->
            <p class="leave_Flow" id="allFlow"><?php echo $taocan['totalDataVolume'] - $taocan['usedDataVolume']; ?></p>
            <p>已用<span id="uesdFlow"><?php echo $taocan['usedDataVolume']; ?></span>MB</p>
        </div>
        <div class="simcard-dated">
            <label>距到期</label><span class="dated-days">40</span>天
            <span id="lblState" class="sim-statustip-green">正常</span>
        </div>
        <div class="simcard-date">（到期日期<span><?php
        $expireDate = empty($taocan['expireDate"'])?time():$taocan['expireDate"'];
                echo date('Y-m-d',$expireDate) ?></span>）</div>
        <div class="renewal-btn"><a href="#">充值续费</a></div>
        <span class="access-remark" style="">注：每月26号为月结日</span>
        <div class="simcard-package"></div>
    </div>
</div>
<footer id="u-bottom">
    <ul><li><div class="liContainer" onclick="toRenewalRecord()"><span class="footer-icon renewalIcon"></span>历史续费记录</div></li><li><div class="liContainer" onclick="toMonthAmount()"><span class="footer-icon amountIcon"></span>本月用量详情</div></li></ul>
</footer>
<input type="hidden" id="hid_simId" value="437185">
<input type="hidden" id="hid_iccid" value="8986061501000710323">


</body></html>
