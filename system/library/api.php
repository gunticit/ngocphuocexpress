<?php
final class API {
	private $url = 'https://central.website500k.com/sysapi.php';
	private $license;

	public function __construct($license) {
		$this->license = pack('H*', $license);
	}
	
	public function request($postfield = array()){
		$postdata = array(
			'license' => $this->license,
			'domain' => $_SERVER['SERVER_NAME'],
			'request' => $this->encrypt(json_encode($postfield))
		);
		 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postdata));
		$response = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($this->decrypt($response), true);
	}

	public function encrypt($plaintext) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->license, $plaintext, MCRYPT_MODE_CBC, $iv);
		$ciphertext = $iv . $ciphertext;
		
		return strtr(base64_encode($ciphertext), '+/=', '-_,');
	}

	public function decrypt($ciphertext_base64) {
		$ciphertext_dec = base64_decode(strtr($ciphertext_base64, '-_,', '+/='));
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv_dec = substr($ciphertext_dec, 0, $iv_size);
		$ciphertext_dec = substr($ciphertext_dec, $iv_size);
		
		return  trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->license, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec));
	}
}