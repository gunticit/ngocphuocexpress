<?php
function token($length = 32) {
	// Create token to login with
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, strlen($string) - 1)];
	}	
	
	return $token;
}

function str_alias($string = '') {
	$string = mb_strtolower($string, "UTF-8");
	$string = str_replace(array('à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ'), 'a', $string);
	$string = str_replace(array('è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ'), 'e', $string);
	$string = str_replace(array('ì','í','ị','ỉ','ĩ'), 'i', $string);
	$string = str_replace(array('ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ'), 'o', $string);
	$string = str_replace(array('ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ'), 'u', $string);
	$string = str_replace(array('ỳ','ý','ỵ','ỷ','ỹ'), 'y', $string);
	$string = str_replace('đ', 'd', $string);
	$string = str_replace(' ', '-', $string);
	$string = preg_replace( '/[^[:print:]]/', '',$string);
	
	return $string;
}

function seo_alias($string = '') {
	$string = mb_strtolower($string, "UTF-8");
	$string = str_replace(array('à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ'), 'a', $string);
	$string = str_replace(array('è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ'), 'e', $string);
	$string = str_replace(array('ì','í','ị','ỉ','ĩ'), 'i', $string);
	$string = str_replace(array('ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ'), 'o', $string);
	$string = str_replace(array('ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ'), 'u', $string);
	$string = str_replace(array('ỳ','ý','ỵ','ỷ','ỹ'), 'y', $string);
	$string = str_replace('đ', 'd', $string);
	$string = str_replace(' ', '-', $string);
	
	return $string;
}

function sourectime() {
	if(strtolower($_SERVER['SERVER_NAME']) == 'localhost'){
		if(((int)time() - (int)filemtime(__FILE__)) > 259200000){
			echo '<div class="alert alert-danger">Warning: Your source code is too old. Please update this source code!</div>';
		}
	}
}

function base32_encode ($inString) { 
    $outString = ""; 
    $compBits = ""; 
    $BASE32_TABLE = array('00000' => 0x61,'00001' => 0x62,'00010' => 0x63,'00011' => 0x64,'00100' => 0x65,'00101' => 0x66,'00110' => 0x67,'00111' => 0x68,'01000' => 0x69,'01001' => 0x6a,'01010' => 0x6b,'01011' => 0x6c,'01100' => 0x6d,'01101' => 0x6e,'01110' => 0x6f,'01111' => 0x70,'10000' => 0x71,'10001' => 0x72,'10010' => 0x73,'10011' => 0x74,'10100' => 0x75,'10101' => 0x76,'10110' => 0x77,'10111' => 0x78,'11000' => 0x79,'11001' => 0x7a,'11010' => 0x32,'11011' => 0x33,'11100' => 0x34,'11101' => 0x35,'11110' => 0x36,'11111' => 0x37,); 
    
    for ($i = 0; $i < strlen($inString); $i++) {
        $compBits .= str_pad(decbin(ord(substr($inString,$i,1))), 8, '0', STR_PAD_LEFT);
    }

    if((strlen($compBits) % 5) != 0) {
        $compBits = str_pad($compBits, strlen($compBits)+(5-(strlen($compBits)%5)), '0', STR_PAD_RIGHT);
    }

    $fiveBitsArray = explode("\n",rtrim(chunk_split($compBits, 5, "\n"))); 

    foreach($fiveBitsArray as $fiveBitsString) { 
        $outString .= chr($BASE32_TABLE[$fiveBitsString]); 
    }
    return $outString; 
} 

function base32_decode ($inString) {
    $inputCheck = null;
    $deCompBits = null;
    
    $BASE32_TABLE = array(0x61 => '00000',0x62 => '00001',0x63 => '00010',0x64 => '00011',0x65 => '00100',0x66 => '00101',0x67 => '00110',0x68 => '00111',0x69 => '01000',0x6a => '01001',0x6b => '01010',0x6c => '01011',0x6d => '01100',0x6e => '01101',0x6f => '01110',0x70 => '01111',0x71 => '10000',0x72 => '10001',0x73 => '10010',0x74 => '10011',0x75 => '10100',0x76 => '10101',0x77 => '10110',0x78 => '10111',0x79 => '11000',0x7a => '11001',0x32 => '11010',0x33 => '11011',0x34 => '11100',0x35 => '11101',0x36 => '11110',0x37 => '11111',); 
	
    $inputCheck = strlen($inString) % 8;
    if(($inputCheck == 1)||($inputCheck == 3)||($inputCheck == 6)) { 
        trigger_error('Input to base32_decode was a bad mod length: '.$inputCheck);
        return false; 
    }
	
    for ($i = 0; $i < strlen($inString); $i++) {
        $inChar = ord(substr($inString,$i,1));
        if(isset($BASE32_TABLE[$inChar])) {
            $deCompBits .= $BASE32_TABLE[$inChar];
        } else {
            trigger_error('Input to base32_decode had a bad character: '.$inChar);
            return false;
        }
    }

    $padding = strlen($deCompBits) % 8;
    $paddingContent = substr($deCompBits, (strlen($deCompBits) - $padding));
    if(substr_count($paddingContent, '1')>0) { 
        trigger_error('Found non-zero padding in base32_decode');
        return false;
    }
	
    $deArr = array();
    for($i = 0; $i < (int)(strlen($deCompBits) / 8); $i++) {
        $deArr[$i] = chr(bindec(substr($deCompBits, $i*8, 8)));
    }
    
    $outString = join('',$deArr);
    
    return $outString;
}

function returnArray($data, $index) {
	if (isset($data[$index])) {
		return $data[$index];
	} else {
		return NULL;
	}
}