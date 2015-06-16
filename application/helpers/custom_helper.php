<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function selectbox($query,$name,$select,$req=true,$opt = ''){
	if($req){
		$text = '<select name="'.$name.'" id="'.$name.'" class="required" '.$opt.'>';
	}else{
		$text = '<select name="'.$name.'" id="'.$name.'" '.$opt.'>';
	}
	$text .= '<option value=""></option>';
	if($query != ''){
		$field = $query->list_fields();
		foreach($query->result() as $r){
			if($select == $r->$field[0]){
				$text .= '<option value="'.$r->$field[0].'" selected>'.$r->$field[1].'</option>';
			}else{
				$text .= '<option value="'.$r->$field[0].'">'.$r->$field[1].'</option>';
			}
		}
		$field = NULL;
		$query->free_result();
	}
	$text .= '</select>';
	return $text;
}
function selectbox_array($arr,$name,$select,$req=true,$opt = ''){
	if($req){
		$text = '<select name="'.$name.'" id="'.$name.'" class="required" '.$opt.'>';
		$text .= '<option value=""></option>';
	}else{
		$text = '<select name="'.$name.'" id="'.$name.'" '.$opt.'>';
	}
	foreach($arr as $key => $value){
		if($select == $key){
			$text .= '<option value="'.$key.'" selected>'.$value.'</option>';
		}else{
			$text .= '<option value="'.$key.'">'.$value.'</option>';
		}
	}
	$text .= '</select>';
	return $text;
}
function label_array($arr,$select){
	$text = NULL;
	foreach($arr as $key => $value){
		if($key == $select){
			$text = $value;
		}
	}
	return $text;
}
function exp_to_lv($exp){
	$lv = 1;
	if($exp > 9){
		$lv = floor($exp / 10)+1;
	}
	return $lv;
}
function image_users($name,$site='128'){
	$path = 'storage/users/'.$site.'/'.$name;
	if(!is_file($path)){
		$path = 'storage/users/'.$site.'/default_users.png';
	}
	$size = getimagesize($path);
	return '<img src="'.base_url().$path.'" height="'.$size[0].'" width="'.$size[1].'" />';	
}
function rel_time($from, $to = null){
	if($from != '0000-00-00 00:00:00'){
		$to = (($to === null) ? (time()) : ($to));
		$to = ((is_int($to)) ? ($to) : (strtotime($to)));
		$from = ((is_int($from)) ? ($from) : (strtotime($from)));
		$units = array (
			'ปี'   => 29030400, // seconds in a year   (12 months)
			'เดือน'  => 2419200,  // seconds in a month  (4 weeks)
			'สัปดาห์'   => 604800,   // seconds in a week   (7 days)
			'วัน'    => 86400,    // seconds in a day    (24 hours)
			'ชั่วโมง'   => 3600,     // seconds in an hour  (60 minutes)
			'นาที' => 60,       // seconds in a minute (60 seconds)
			'วินาที' => 1         // 1 second
		);
		$diff = abs($from - $to);
		$suffix = (($from > $to) ? ('ในอีก') : (' ผ่านมา'));
		$output = '';
		foreach($units as $unit => $mult)
		if($diff >= $mult){
			$and = (($mult != 1) ? ('') : (' '));
			$output .= ', '.$and.intval($diff / $mult).' '.$unit.((intval($diff / $mult) == 1) ? ('') : (' '));
			$diff -= intval($diff / $mult) * $mult;
		}
		$output .= ' '.$suffix;
		$output = substr($output, strlen(', '));
	}else{
		$output = '';
	}
	return $output;
}
function tags_allow($text){
	return strip_tags($text,'<b><i><u><p><img><font><blockquote>');
}
function get_description($file){
	return character_limiter(strip_tags(preg_replace("/\r\n|{|}|[|]|:|;|\"|<|>|  /",'',$file)),200);
}
function get_keywords($file){ 
    $h1tags = preg_match_all("/(<b>)(.*)(<\/b>)/ismU",$file,$patterns); 
    $res = array(); 
    array_push($res,$patterns[2]); 
    array_push($res,count($patterns[2]));
	$keyword_text = '';
	foreach($res as $keyword){
		if(is_array($keyword)){
			foreach($keyword as $key){
				$keyword_text .= $key.',';
			}
		}
	}
    return substr($keyword_text,0,-1); 
} 
?>