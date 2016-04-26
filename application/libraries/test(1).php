<?php
class Test {
	
	public function ibrateplan() {
		$data = array (
				't' => time (),
				'v' => '1',
				'iccid' => '8986061501000000696'
		);
		$data ['sign'] = md5 ('/api/device?a=detail' . "&iccid=". $data["iccid"] . '&t=' . $data ['t'] . '&v=' . $data ['v']);
		$result = $this->curl_post ( 'http://test.ibilling.com.cn/api/device?a=detail', $data );
		print_r ( $result );
		if ($result) {
			$json = json_decode ( $result, true );
			if (! $json) {
				return false;
			}
			return $json;
		}
		return false;
	}
	
	public function curl_post($url, $post) {
		$header = [ 
				//'Content-Type: application/json; charset=utf-8',
				'IBkey: C7CsjmROC5Ns34or' 
		];
		$b = "&t=" . $post["t"] . "&v=" . $post["v"] . "&sign=" . $post["sign"] . "&iccid=" . $post["iccid"];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER,FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60*2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $b);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		
		$document = curl_exec ( $ch );
		//$info = curl_getinfo ( $ch );
		curl_close ( $ch );
		return $document;
	}
	
}

$test = new Test();
$test->ibrateplan();








