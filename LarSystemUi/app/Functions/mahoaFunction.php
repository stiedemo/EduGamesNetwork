<?php  

function decodeRequestsPost($e)
{
	if($e == null){
		return null;
	}
	return base64_decode(base64_decode(base64_decode($e)));
}
function encodeDataToDTB($e)
{
	if($e == null){
		return null;
	}
	$e = base64_encode($e);

	for ($i=0; $i < (strlen($e) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $e[$i + 1];
		$e[$i + 1] = $e[$i];
		$e[$i] = $tg;
	}

	$e = base64_encode($e) . 'a';

	return $e;
}
function decodeDataToDTB($e)
{
	if($e == null){
		return null;
	}
	$e = mb_substr($e, 0, mb_strlen($e) - 1);
	$e = base64_decode($e);

	for ($i=0; $i < (strlen($e) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $e[$i + 1];
		$e[$i + 1] = $e[$i];
		$e[$i] = $tg;
	}

	$e = base64_decode($e);

	return $e;
}
function encodeDate($e){
	if($e == null){
		return null;
	}
	# Định dạng truyền vào là: Y-M-D:
	$e = explode('-', $e);
	# Nếu là năm lẻ thì cộng vào 3 năm còn nếu là năm chẵn thì cộng vào 4 năm:
	if($e[0] % 2 == 0){
		$e[0] = $e[0] + 4;
	}else{
		$e[0] = $e[0] + 3;
	}
	# Nếu là tháng lẻ thì cộng thêm 1 nếu là tháng chẵn thì trừ đi 1
	if($e[1] % 2 == 0){
		$e[1] = $e[1] - 1;
	}else{
		$e[1] = $e[1] + 1;
	}
	# Nếu ngày chẵn thì trừ 1 nếu ngày lẻ thì cộng 1
	if($e[2] % 2 == 0){
		$e[2] = $e[2] - 1;
	}else{
		$e[2] = $e[2] + 1;
	}
	return implode('-', $e);
}
function decodeDate($e){
	if($e == null){
		return null;
	}
	# Định dạng truyền vào là: Y-M-D:
	$e = explode('-', $e);

	# Nếu ngày chẵn thì trừ 1 nếu ngày lẻ thì cộng 1
	if($e[2] % 2 == 0){
		$e[2] = $e[2] - 1;
	}else{
		$e[2] = $e[2] + 1;
	}
	# Nếu là tháng lẻ thì cộng thêm 1 nếu là tháng chẵn thì trừ đi 1
	if($e[1] % 2 == 0){
		$e[1] = $e[1] - 1;
	}else{
		$e[1] = $e[1] + 1;
	}
	# Nếu là năm lẻ thì cộng vào 3 năm còn nếu là năm chẵn thì cộng vào 4 năm:
	if($e[0] % 2 == 0){
		$e[0] = $e[0] - 4;
	}else{
		$e[0] = $e[0] - 3;
	}
	return implode('-', $e);
}
function emailchange($email)
{
	if($email == null){
		return $email;
	}
	#tách phần đầu ra:
	$in_email = explode('@', $email)[0];
	$out_email = null;
	$out_email[0] = null;
	$out_email[1] = null;
	if (isKyTuDacBiet($in_email)){
		$in_email = strtolower($in_email);
		for ($i=0; $i < (strlen($in_email) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_email[$i + 1];
			$in_email[$i + 1] = $in_email[$i];
			$in_email[$i] = $tg;
			# Chơi kiểu CHia Bài:
			$out_email[0] = $out_email[0] . $in_email[$i];
			$out_email[0] = $out_email[0] . $in_email[$i + 1];
			$out_email[1] = $in_email[$i] . $out_email[1];
		}
		for ($i=0; $i < (strlen($in_email) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_email[$i + 1];
			$in_email[$i + 1] = $in_email[$i];
			$in_email[$i] = $tg;
		}
		#Bước cuối: 
		$out_email = null;
		for ($i=0; $i < (strlen($in_email)) ; $i ++) { 
			$out_email[] = ord($in_email[$i]);
		}
		$in_email = implode('0_0', $out_email);
		for ($i=0; $i < (strlen($in_email) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_email[$i + 1];
			$in_email[$i + 1] = $in_email[$i];
			$in_email[$i] = $tg;
		}
	    return $in_email . '@' . explode('@', $email)[1];
	}else{
		return false;
	}
}
function emaildecode($email)
{
	if($email == null){
		return $email;
	}
	$in_email = explode('@', $email)[0];
	for ($i=0; $i < (strlen($in_email) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_email[$i + 1];
		$in_email[$i + 1] = $in_email[$i];
		$in_email[$i] = $tg;
	}
	$in_email = explode('0_0', $in_email);
	$rq = null;
	foreach ($in_email as $value) {
		$rq = $rq. chr($value);
	}
	$in_email = $rq;
	return $in_email. '@' . explode('@', $email)[1];
}
function manychange($phone)
{
	if($phone == null){
		return $phone;
	}
	$in_phone = $phone;
	$out_phone = null;
	$out_phone[0] = null;
	$out_phone[1] = null;
	$in_phone = strtolower($in_phone);
	for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_phone[$i + 1];
		$in_phone[$i + 1] = $in_phone[$i];
		$in_phone[$i] = $tg;
		# Chơi kiểu CHia Bài:
		$out_phone[0] = $out_phone[0] . $in_phone[$i];
		$out_phone[0] = $out_phone[0] . $in_phone[$i + 1];
		$out_phone[1] = $in_phone[$i] . $out_phone[1];
	}
	for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_phone[$i + 1];
		$in_phone[$i + 1] = $in_phone[$i];
		$in_phone[$i] = $tg;
	}
	#Bước cuối: 
	$out_phone = null;
	for ($i=0; $i < (strlen($in_phone)) ; $i ++) { 
		$out_phone[] = ord($in_phone[$i]);
	}
	$in_phone = implode('0_0', $out_phone);
	for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_phone[$i + 1];
		$in_phone[$i + 1] = $in_phone[$i];
		$in_phone[$i] = $tg;
	}
    return $in_phone;
}
function manydecode($phone)
{
	if($phone == null){
		return $phone;
	}
	$in_phone = $phone;
	for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_phone[$i + 1];
		$in_phone[$i + 1] = $in_phone[$i];
		$in_phone[$i] = $tg;
	}
	$in_phone = explode('0_0', $in_phone);
	$rq = null;
	foreach ($in_phone as $value) {
		$rq = $rq. chr($value);
	}
	$in_phone = $rq;
	return $in_phone;
}
function phonechange($phone)
{
	if($phone == null){
		return $phone;
	}
	$in_phone = $phone;
	$out_phone = null;
	$out_phone[0] = null;
	$out_phone[1] = null;
	if (isNumberphone($in_phone)){
		$in_phone = strtolower($in_phone);
		for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_phone[$i + 1];
			$in_phone[$i + 1] = $in_phone[$i];
			$in_phone[$i] = $tg;
			# Chơi kiểu CHia Bài:
			$out_phone[0] = $out_phone[0] . $in_phone[$i];
			$out_phone[0] = $out_phone[0] . $in_phone[$i + 1];
			$out_phone[1] = $in_phone[$i] . $out_phone[1];
		}
		for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_phone[$i + 1];
			$in_phone[$i + 1] = $in_phone[$i];
			$in_phone[$i] = $tg;
		}
		#Bước cuối: 
		$out_phone = null;
		for ($i=0; $i < (strlen($in_phone)) ; $i ++) { 
			$out_phone[] = ord($in_phone[$i]);
		}
		$in_phone = implode('0_0', $out_phone);
		for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
			# Thay đổi và đảo vị trí:
			$tg = $in_phone[$i + 1];
			$in_phone[$i + 1] = $in_phone[$i];
			$in_phone[$i] = $tg;
		}
	    return $in_phone;
	}else{
		return false;
	}
}
function phonedecode($phone)
{
	if($phone == null){
		return $phone;
	}
	$in_phone = $phone;
	for ($i=0; $i < (strlen($in_phone) - 1) ; $i += 2) { 
		# Thay đổi và đảo vị trí:
		$tg = $in_phone[$i + 1];
		$in_phone[$i + 1] = $in_phone[$i];
		$in_phone[$i] = $tg;
	}
	$in_phone = explode('0_0', $in_phone);
	$rq = null;
	foreach ($in_phone as $value) {
		$rq = $rq. chr($value);
	}
	$in_phone = $rq;
	return $in_phone;
}
function isKyTuDacBiet($text)
{
	$pattern = '/[a-zA-Z0-9_.]/m';
	preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);
	$check = null;
	foreach ($matches as $value) {
		$check = $check . $value[0];
	}
	if ($text == $check){
	    return true;
	}else{
		return false;
	}
}
function dellKyTuDacBiet($text)
{
	$pattern = '/[a-zA-Z0-9_.]/m';
	preg_match_all($pattern, $text, $matches, PREG_SET_ORDER, 0);
	$check = null;
	foreach ($matches as $value) {
		$check = $check . $value[0];
	}
	return $check;
}
function isNumberphone($phone)
{
	if($phone == null){
		return $phone;
	}
	$pattern = '/^(84|0)[0-9]{9}/m';
	preg_match_all($pattern, $phone, $matches, PREG_SET_ORDER, 0);
	$check = null;
	foreach ($matches as $value) {
		$check = $check . $value[0];
	}
	if ($phone == $check){
	    return true;
	}else{
		return false;
	}
}
?>