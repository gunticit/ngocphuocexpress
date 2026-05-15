<?php
define('DB_PREFIX', 'tbl');

require_once(dirname(dirname(__FILE__)).'/configuration.php');
require_once(dirname(dirname(__FILE__)).'/init.php');

require_once('apiex/db.php');
require_once('apiex/encryption.php');
require_once('apiex/permission.php');
require_once('apiex/request.php');

$db = new DB($db_host,$db_username,$db_password,$db_name);
$permission = new Permission;
$request = new Request;
$encryption = new Encryption('eb7e7354a99be793031310c16f363ec7803a5c8ba33413fbd30674479d67d078');

$IPs  = unserialize($db->query("SELECT * FROM `" . DB_PREFIX . "configuration` WHERE `setting` = 'APIAllowedIPs'")->row['value']);

$servers = $db->query("SELECT * FROM `" . DB_PREFIX . "servers` WHERE `disabled` = '0'")->rows;

foreach ($servers as $server) {
	$IPs[]['ip'] = $server['ipaddress'];
}

if(!$permission->checkIP($IPs)){
	$response = array();
	$response['result'] = 'error';
	$response['message'] = 'Authentication Failed IP';
	echo $encryption->encrypt(json_encode($response));
	exit;
}

if(isset($request->request['request']) && !empty($request->request['request'])) {
	
	$request = json_decode($encryption->decrypt($request->post['request']), true);
	
	if ($request) {
		if ($request['action'] == 'change_hosting_password') {
			$user = $request['data']['user'];
			
			$values = array (
				'password2' => $request['data']['password']
			);
			
			$result = localAPI('encryptpassword' , $values, 'whmcs500K');
			
			$password = $result['password'];
			
			$db->query("UPDATE `" . DB_PREFIX . "hosting` SET `password` = '" . $db->escape($password) . "' WHERE `username` = '" . $db->escape($user) . "'");
			
			$response = json_encode(array(
				'result' => 'success',
				'data' => array()
			));
			
			echo $encryption->encrypt($response);
		}
		
		if($request['action'] == 'getuseronserver'){
			if(isset($request['data']['server_ip']) && !empty($request['data']['server_ip'])){
				$server_ip = $request['data']['server_ip'];
				
				$data = $db->query("SELECT ht.username user, ht.password password2, ht.domain domain, c.firstname firstname, c.lastname lastname, c.email email FROM `" . DB_PREFIX . "servers` sv LEFT JOIN `" . DB_PREFIX . "hosting` ht ON (sv.id = ht.server) LEFT JOIN `" . DB_PREFIX . "clients` c ON (ht.userid = c.id) WHERE sv.ipaddress='".$db->escape($server_ip)."'")->rows;
				
				foreach ($data as $key => $values) {
					$result = localAPI('decryptpassword' , $values, 'whmcs500K');
					
					$data[$key]['password'] = $result['password'];
				}
				
				$response['result'] = 'success';
				$response['data']['server'] = $data;
				echo $encryption->encrypt(json_encode($response));
				exit;
			}else{
				$response = array();
				$response['result'] = 'error';
				$response['message'] = "Server's IP is empty!";
				echo $encryption->encrypt(json_encode($response));
				exit;
			}
		}
		
		if($request['action'] == 'domainpricing'){
			if(isset($request['data']['domain']) && !empty($request['data']['domain'])){
				$domain_arr = explode('.',$request['data']['domain']);
				$extension = '';
				
				if(count($domain_arr) > 1){
					for($i = 1; $i < count($domain_arr); $i++){
						$extension .= '.'.$domain_arr[$i];
					}
					$domain = $request['data']['domain'];
				}else{
					$extension = '.com';
					$domain = $request['data']['domain'].$extension;
				}
				
				if(isset($request['data']['currency']) && !empty($request['data']['currency'])){
					$currency_name = strtoupper($request['data']['currency']);
				}else{
					$currency_name = 'USD';
				}
				
				$currency = $db->query("SELECT * FROM `" . DB_PREFIX . "currencies` WHERE UPPER(code) = '".$db->escape($currency_name)."'")->row['id'];
				
				if(empty($currency)){
					$query = $db->query("SELECT * FROM `" . DB_PREFIX . "currencies`")->row;
					$currency = $query['id'];
					$currency_name = $query['code'];
				}
				
				$query = $db->query("SELECT dp.id id, p.type type, p.msetupfee 1year, p.qsetupfee 2year, p.ssetupfee 3year, p.asetupfee 4year, p.bsetupfee 5year, p.monthly 6year, p.quarterly  7year, p.semiannually 8year, p.annually 9year, p.biennially 10year FROM `" . DB_PREFIX . "domainpricing` dp LEFT JOIN `" . DB_PREFIX . "pricing` p ON dp.id = p.relid WHERE dp.extension = '".$db->escape($extension)."' AND (p.type = 'domainregister' OR p.type = 'domaintransfer' OR p.type = 'domainrenew' ) AND currency = '".$db->escape($currency)."'")->rows;
				
				foreach($query as $k => $v){
					$query[$k]['currency'] = $currency_name;
				}
				$response = array();
				if(!empty($query)){
					$response['result'] = 'success';
					$response['status'] = 'available';
					$response['domain'] = $domain;
					$response['price'] = $query;
				}
				echo $encryption->encrypt(json_encode($response));
				exit;
			}else{
				$response = array();
				$response['result'] = 'error';
				$response['message'] = 'Domain is empty!';
				echo $encryption->encrypt(json_encode($response));
				exit;
			}
		}
		
		if ($request['action'] == 'gethostingpassword') {
			if(isset($request['data']['domain']) && !empty($request['data']['domain'])){
				$data = $db->query("SELECT ht.username user, ht.password password2, ht.domain domain, c.firstname firstname, c.lastname lastname, c.email email, sv.ipaddress ipaddress FROM `" . DB_PREFIX . "servers` sv LEFT JOIN `" . DB_PREFIX . "hosting` ht ON (sv.id = ht.server) LEFT JOIN `" . DB_PREFIX . "clients` c ON (ht.userid = c.id) WHERE ht.domain = '" . $db->escape($request['data']['domain']) . "'")->rows;
				
				$password = array();
				
				foreach ($data as $key => $values) {
					$result = localAPI('decryptpassword' , $values, 'whmcs500K');
					
					$data[$key]['password'] = $result['password'];
				}
				
				$response['result'] = 'success';
				$response['data'] = $data;
				echo $encryption->encrypt(json_encode($response));
				exit;
			} else {
				$response = array();
				$response['result'] = 'error';
				$response['message'] = 'Domain is empty!';
				echo $encryption->encrypt(json_encode($response));
				exit;
			}
		}
	}
}else{
	$response = array();
	$response['result'] = 'error';
	$response['message'] = 'Authentication Failed Action';
	echo $encryption->encrypt(json_encode($response));
	exit;
}
?>