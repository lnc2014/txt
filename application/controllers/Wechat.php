<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/15 0015
 * Time: 下午 2:21
 */

class wechat extends CI_Controller{


    public function index(){
        $result = $this->get_device_detail('');
        echo $result;
    }

    /**
     * 实名认证页面
     */
    public function real_name_auth(){

        $this->load->view('wechat/real_name_auth');

    }

    /**
     * 运营商登录
     */

    public function operators_login(){
        $this->load->helper('url');
        $this->load->view('wechat/operators_login');
    }
    public function test(){
        $result = $this->get_device_detail('89860615010015682898');
        echo $result;
    }

    public function use_api(){
        $iccid = $_POST['iccid'];

        if(empty($iccid)){
            $result = array(
                'code'=>0001,
                'msg'=>'输入的iccid序列号不能为空'
            );
        }
        $device_detail = $this->get_device_detail($iccid);
        $device_detail_array = json_decode($device_detail,true);

        if($device_detail_array['code'] == 100){
            session_start();
            $_SESSION['iccid'] = $iccid;

        }
        echo $device_detail_array['code'];
    }
    /**
     * 查询首页
     */
    public function check(){
        $this->load->helper('url');
        session_start();

        $second = $this->uri->segment(3);
        if($second == 'second'){
            unset($_SESSION['iccid']);
        }
        $iccid = empty($_SESSION['iccid'])?'':$_SESSION['iccid'];

        if(!empty($iccid)){
            $url = site_url('wechat/taocan_detail');
            $url = $url.'?iccid='.$iccid;
                echo "<script>
                        window.location.href='".$url."';
                      </script>";
                exit;
        }


        $this->load->view('wechat/check');

    }
    public function taocan_detail(){
        $iccid = $this->input->get('iccid');

        if(empty($iccid)){//直接跳转回去查询页面
            $this->load->helper('url');
            $this->load->view('wechat/check');
        }
        $device = $this->get_device_detail($iccid);
        $device = json_decode($device,true);

        $device_data = $device['data'];


//        var_dump($device_data);exit;
        $this->load->helper('url');
        $this->load->view('wechat/taocan_detail',array('taocan'=>$device_data));
    }
    /**
     * 获取设备详情
     * @param $iccid
     * @return mixed
     */
    public function get_device_detail($iccid){

        $iccid = empty($iccid)?'8986061501000000696':$iccid;//暂时为空给一个测试数据
        $data = array (
            't' => time (),
            'v' => '1',
            'iccid' => $iccid
        );

        $sign = md5 ('/api/device?a=detail' . "&iccid=". $data["iccid"] . '&t=' . $data ['t'] . '&v=' . $data ['v']);

        $this->load->library('Curl');
//        $url = 'http://test.ibilling.com.cn/api/device?a=detail';
        $url = 'http://www.ibilling.com.cn/api/device?a=detail';
        $send_param = "&t=" . $data["t"] . "&v=" . $data["v"] . "&sign=" . $sign . "&iccid=" . $data["iccid"];
        $result = $this->curl->curl_post($url,$send_param);
        return $result;

    }

    /**
     * 设备续费
     * @param $iccid
     * @param $ratePlanId
     * @return mixed
     */
    public function device_recharge($iccid, $ratePlanId){

        $iccid = empty($iccid)?'8986061501000000696':$iccid;//暂时为空给一个测试数据

        $data = array (
            't' => time (),
            'v' => '1',
            'iccid' => $iccid,
            'ratePlanId'=>$ratePlanId
        );

        $sign = md5 ('/api/device?a=recharge' . "&iccid=". $data["iccid"] . '&t=' . $data ['t'] . '&v=' . $data ['v']. '&ratePlanId=' . $data ['ratePlanId']);

        $this->load->library('Curl');
        $url = 'http://www.ibilling.com.cn/api/device?a=recharge';
        $send_param = "&t=" . $data["t"] . "&v=" . $data["v"] . "&sign=" . $sign . "&iccid=" . $data["iccid"]. "&ratePlanId=" . $data["ratePlanId"];
        $result = $this->curl->curl_post($url,$send_param);
        return $result;

    }

    /**
     * 套餐列表
     * @return mixed
     */
    public function get_menu_list(){

        $data = array (
            't' => time (),
            'v' => '1',
        );

        $sign = md5 ('/api/ibrateplan?a=list' . '&t=' . $data ['t'] . '&v=' . $data ['v']);
        $this->load->library('Curl');
        $url = 'http://www.ibilling.com.cn/api/ibrateplan?a=list';
        $send_param = "&t=" . $data["t"] . "&v=" . $data["v"]. "&sign=" . $sign;
        $result = $this->curl->curl_post($url,$send_param);
        return $result;

    }

}