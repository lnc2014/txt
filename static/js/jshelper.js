(function() {
	'use strict';

	function getUrlQuery(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)
            return unescape(r[2]);
        return null;
    }

	/**
	 *! 确认框封装
	 *! 调用例子：
	 *! 打开：shared.cfm.open('确定要提交吗？');
	 *! 关闭：shared.cfm.close();
	 */
	var cfm = (function() {
		var $cfm = null, $content = null;

		return {
			open: open,
			close: close
		}

		function init_cfm_ele() {
			var html = [];
			html.push('<div class="m-confirm-bg"></div>');
			html.push('<div class="m-confirm-container">');
			html.push('<div class="m-confirm-msg"></div>')
			html.push('<div class="m-confirm-btn">');
			html.push('<div class="m-confirm-btn-cols1">');
			html.push('<button type="button" class="m-btn m-btn-info m-btn-block" onclick="shared.cfm.close()">关闭</button>');
			html.push('</div>');
			html.push('<div class="m-confirm-btn-cols2">');
			html.push('<button type="button" class="m-btn m-btn-info m-btn-block">我的主页</button>');
			html.push('</div>');
			html.push('</div>');
			html.push('</div>');
			$('body').append(html.join(''));
		}

		function open(text) {
			if($cfm === null)
				init_cfm_ele();
			$cfm = $(".m-confirm-bg");
			$content = $(".m-confirm-container");

			$('.m-confirm-msg', $content).text(text);
			$cfm.show();
			$content.show();
		}

		function close() {
			if($cfm !== null) 
				$cfm.hide();
			if($content !== null)
				$content.hide();
		}

	}());

	/**
	 *! 信息框封装，用于显示详细地址为主
	 *! 调用例子：
	 *! 打开：shared.msg.open('河北省衡水市桃城区...');
	 *! 关闭：shared.msg.close();
	 */
	var msg = (function() {
		var $msg = null, $content = null;

		return {
			open: open,
			close: close
		}

		function init_msg_ele() {
			var html = [];
			html.push('<div class="m-confirm-bg"></div>');
			html.push('<div class="m-confirm-container">');
			html.push('<div class="m-confirm-msg"></div>');
			html.push('<div class="m-confirm-btn">');
			html.push('<div class="m-row">');
			html.push('<div class="m-col-1"></div>');
			html.push('<div class="m-col-10">');
			html.push('<button type="button" class="m-btn m-btn-info m-btn-block" onclick="shared.msg.close()">关闭</button>');
			html.push('</div>');
			html.push('<div class="m-col-1"></div>');
			html.push('</div>');
			html.push('</div>');
			html.push('</div>');
			$('body').append(html.join(''));
		}

		function open(text) {
			if($msg === null)
				init_msg_ele();
			$msg = $(".m-confirm-bg");
			$content = $(".m-confirm-container");

			$('.m-confirm-msg', $content).text(text);
			$msg.show();
			$content.show();
		}

		function close() {
			if($msg !== null) 
				$msg.hide();
			if($content !== null)
				$content.hide();
		}

	}());

    //打开等待提示窗口
    var loadCfm = (function() {
		var $cfm = null, $content = null;

		return {
			open: open,
			close: close
		}

		function init_cfm_ele() {
		    var html = [];
		    html.push('<div class="m-confirm-bg"></div>');
		    html.push('<div class="m-confirm-loading">');

		    html.push('<div style="float: left;margin-top: 9px;margin-left: 10px;"><img src="../App_Themes/images/loading.gif" /> </div>');
		    html.push('<div class="m-loading-msg">正在处理中...</div>');
		    html.push('</div>');
		    $('body').append(html.join(''));
		}

		function open(text) {
			if($cfm === null)
				init_cfm_ele();
			$cfm = $(".m-confirm-bg");
			$content = $(".m-confirm-loading");

			//$('.m-loading-msg', $content).text(text);
			$cfm.show();
			$content.show();
		}

		function close() {
			if($cfm !== null) 
				$cfm.hide();
			if($content !== null)
				$content.hide();
		}

    }());

    var timehelper = (function() {

    	return {
    		getTimeSpaceHHMM: getTimeSpaceHHMM,
    		getTimeFormatMDHM: getTimeFormatMDHM
    	};

    	/**
    	 *! 获取一段时间的时长
    	 *# 参数格式(start_time/end_time)：2015-05-01 07:06:06
    	 *# 注意：end_time > start_time
    	 *! 返回格式：HH:mm
    	 */
    	function getTimeSpaceHHMM(start_time, end_time) {
    		var st = start_time.split(' ');
    		var et = end_time.split(' ');
    		var ar_ds = st[0].split('-');
			var ar_ts = st[1].split(':');
			var ar_de = et[0].split('-');
			var ar_te = et[1].split(':');
			var ds = new Date(ar_ds[0], ar_ds[1] - 1, ar_ds[2], ar_ts[0], ar_ts[1]);
			var de = new Date(ar_de[0], ar_de[1] - 1, ar_de[2], ar_te[0], ar_te[1]);

			var miss = de.getTime() - ds.getTime();
			var hhmm = [];
			var hh = (miss / 3600000).toFixed(0);
			var mm = ((miss % 3600000) / 60000).toFixed(0);
			hhmm.push(hh < 10 ? '0' + hh : hh);
			hhmm.push(mm < 10 ? '0' + mm : mm);

			return hhmm.join(':');
    	}

    	/**
    	 *! 返回简略的日期时间格式
    	 *# 参数格式(date_time)：2015-05-01 07:06:06
    	 *! 返回格式：MM-dd HH:mm
    	 *! 如：05-01 07:06
    	 */
    	function getTimeFormatMDHM(date_time) {
    		var t = date_time.split(' ');
    		var md = t[0].split('-');
    		var hm = t[1].split(':');
    		return md[1] + '-' + md[2] + ' ' + hm[0] + ':' + hm[1];
    	}

    }());

    function getMyLocation(callBackCurPosition){
       var options = {
           enableHighAccuracy: true, 
           maximumAge: 3000
       }
       if(navigator.geolocation){
           //浏览器支持geolocation
           navigator.geolocation.getCurrentPosition(callBackCurPosition, callBackonError, options);
       }else{
           //浏览器不支持geolocation
       }
   }

   function callBackonError(error) {
   	   switch(error.code){
           case 1:
           		alert("位置服务被拒绝");
           		break;
           case 2:
           		alert("暂时获取不到位置信息");
           		break;
           case 3:
           		alert("获取信息超时");
           		break;
           case 4:
            	alert("未知错误");
           		break;
       }
   }

   // 保留小数点后几位
   function disposeNumber(data, subcount){
	    if(data == null || data == ""){
	        return 0;
	    }else if(data.toString().indexOf(".") == -1){
	        return data;
	    }else{
	        return round(data, subcount);
	    }
	}

	function round(v,e){
	    var t=1;
	    for(;e>0;t*=10,e--);
	    for(;e<0;t/=10,e++);
	    return Math.round(v*t)/t;
	}

	function setSelIndex(obj, val){
	    for(var i=0; i<obj.length; i++){
	        if(obj.options[i].value === val){
	            obj.selectedIndex = i;
	            break;
	        }
	    }
	}

	function getOptionTextByVal(objSlt, val){
	    var sltText = "";
	    for(var i=0; i<objSlt.length; i++){
	        if(objSlt.options[i].value === val){
	            sltText = objSlt.options[i].text;
	            break;
	        }
	    }
	    return sltText;
	}

	// 解析地址接口
	function analyze_insert_address(lon, lat, path, element) {
		var url = path + 'api/GeoCoding';
		$.get(url, { lon: lon, lat: lat }).
		done(function(data) {
			if(data === null || data === '' || data === 'undefined')
				return;
			if(data.error !== 0)
				return;
			$(element).text(data.result);
		})
		.fail(function() {
		    console.log('error');
		});
	}

	//判断经纬度是否合法
	function isCoordVaild(x) {
	    var flag = false;
	    if(x !== null) {
	        if(!isNaN(x)) {
	            if(x <= 180 && x > -180 && x !== 0) {
	                flag = true;
	            }
	        }
	    }
	    return flag;
	}

	/**
	 *! 定义全局函数对象
	 *! 调用：		$.fn(data, namespace);
	 *! data: 		[ [ 'map', map ], [ 'init', init ], [ 'setapp', setapp ] ]
	 *! namespace:  命名空间
	 */
	function fn(data, namespace) {
		var _count = data.length;
		window[namespace] = window[namespace] || {};
		for(var i=0; i<_count; i++) {
			window[namespace][ data[i][0] ] = window[namespace][ data[i][0] ] || data[i][1];
		}
	}
	
	fn([ 
		['fn', fn],
		['cfm', cfm],
		['getUrlQuery', getUrlQuery], 
		['cfm', cfm],
		['msg', msg],
        ['loadCfm', loadCfm],
        ['getMyLocation', getMyLocation],
        ['disposeNumber', disposeNumber],
        ['setSelIndex', setSelIndex],
        ['getOptionTextByVal', getOptionTextByVal],
        ['timehelper', timehelper],
        ['analyze_insert_address', analyze_insert_address],
        ['isCoordVaild', isCoordVaild]
	], 'jshelper');

}());

var shared = window['jshelper'];