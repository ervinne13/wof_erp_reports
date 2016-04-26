<?php



if ( ! function_exists('dump'))
{
	function dump($array = NULL)
	{
		
			echo '<pre>';
				var_dump($array);
			echo '</pre>';
		
	}
}

if ( ! function_exists('pre'))
{
	function pre($array = NULL)
	{
		
			echo '<pre>';
				print_r($array);
			echo '</pre>';
		
	}
}

if ( ! function_exists('__parse'))
{
	function __parse($body = NULL,$array = NULL)
	{
		
			if(count($array) > 1){
				foreach($array as $key => $value)
				{
					$body = str_replace('%%'.$key.'%%',$value,$body);
				}	
			}else{
				$body = str_replace('%%'.$key.'%%',$value,$body);
			}
			return $body;
		
	}
}

if ( ! function_exists('is_home'))
{
	function is_home()
	{
		
		$ci =& get_instance();
		$m = $ci->router->fetch_method();
		$c = $ci->router->fetch_class();
		
		if($m == 'index' AND $c =='home')
		{
			return TRUE;
		}
		elseif($c == 'ecommerce' AND $m == 'index'){
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
}


if ( ! function_exists('m'))
{
	function m()
	{
		
		$ci =& get_instance();
		return $ci->router->fetch_method();
		
	}
}
if ( ! function_exists('c'))
{
	function c()
	{
		
		$ci =& get_instance();
		return $ci->router->fetch_class();
		
	}
}


if ( ! function_exists('urlMe'))
{
	function urlMe($url = NULL)
	{
			return '<a href="'.$url.'" target="_blank">'.$url.'</a>';
		
	}
}

if ( ! function_exists('seg'))
{
	function seg($s = NULL)
	{
		
		$ci =& get_instance();
		return $ci->uri->segment($s);
		
	}
}

if ( ! function_exists('extract_bread'))
{
	function extract_bread($array = NULL)
	{
		
		$bread = "";
		foreach($array as $key => $val)
		{
			$bread .= '<li><a href="'.$key.'">'.$val.'</a></li>';
			
		}
		return $bread;
		
	}
}

function diffDays ($d1, $d2) {
// Return the number of days between the two dates:

  return round(abs(strtotime($d1)-strtotime($d2))/86400);

}  // end function dateDiff

if ( ! function_exists('DateDiff'))
{
	function DateDiff($date2 = NULL,$date1 = NULL,$return = NULL)
	{
	$diff = abs(strtotime($date2) - strtotime($date1)); 

	$years   = floor($diff / (365*60*60*24)); 
	$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
	$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
	//echo $date2.'-'.$date1.$days;
	if($return == 'years'){
		return $years;
	}
	elseif($return =='months'){
		return $months;
	}
	elseif($return=='days'){
		
		return $days;
	}else{
		return $days;
	}
		
	}
}

if ( ! function_exists('generate_pass'))
{
	function generate_pass( $length ) {
	
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    return substr(str_shuffle($chars),0,$length);
	
	}
}
 
function countries(){
	$countries = array(
	 "ar" => "Arabic",
	 "bg" => "Bulgarian",
	 "ca" => "Catalan",
	 "zh" => "Chinese",
	 "zh-Hant" => "Chinese (simplified)",
	 "zh-Hans" => "Chinese (traditional)",
	 "hr" => "Croatian",
	 "cs" => "Czech",
	 "nl" => "Dutch",
	 "en" => "English",
	 "et" => "Estonian",
	 "fil" => "Filipino",
	 "fi" => "Finnish",
	 "fr" => "French",
	 "de" => "German",
	 "el" => "Greek",
	 "he" => "Hebrew",
	 "hi" => "Hindi",
	 "hu" => "Hungarian",
	 "is" => "Icelandic",
	 "id" => "Indonesian",
	 "it" => "Italian",
	 "ja" => "Japanese",
	 "ko" => "Korean",
	 "lv" => "Latvian",
	 "lt" => "Lithuanian",
	 "ms" => "Malay",
	 "no" => "Norwegian",
	 "fa" => "Persian",
	 "pl" => "Polish",
	 "pt" => "Portuguese",
	 "ro" => "Romanian",
	 "ru" => "Russian",
	 "sr" => "Serbian",
	 "sk" => "Slovak",
	 "sl" => "Slovenian",
	 "es" => "Spanish",
	 "sv" => "Swedish",
	 "th" => "Thai",
	 "tr" => "Turkish",
	 "uk" => "Ukrainian",
	 "ur" => "Urdu",
	 "vi" => "Vietnamese"

);

return $countries;
}

/**
 * Get Youtube video ID from URL
 *
 * @param string $url
 * @return mixed Youtube video ID or FALSE if not found
 */
function getytid($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if($qs['vi']){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}


function generateSlug($phrase)
{
    $result = strtolower($phrase);

    $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
    $result = trim(preg_replace("/[\s-]+/", " ", $result));
    $result = preg_replace("/\s/", "-", $result);

    return $result;
}


function server()
{
    return $_SERVER['SERVER_NAME'];
}


function method()
{
	$ci =& get_instance();
    return $ci->router->fetch_method();
}

function extract_image_from_string($string){
	
	 $image = preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $string, $image);
	 
	 if(is_array($image) AND $image AND array_key_exists('src',$image)){
	  	return $image['src'];
	  }
	  else{
	  	return FALSE;
	  }
	  
}

function extract_whole_image($string){
	
	preg_match('#(<img.*?>)#', $string, $results);
	
	if(array_key_exists(1,$results)){
		return $results[1];
	}
	
}
											
function findExtension ($filename)
{
   $filename = strtolower($filename) ;
   $exts = explode(".", $filename) ;
   $n = count($exts)-1;
   $exts = $exts[$n];
   return $exts;
}


function month_diff($datetime2){
	$datetime2 = date_create($datetime2);
	$datetime1 = date_create(date('Y-m-d'));
	$interval = date_diff($datetime1, $datetime2);
	return $interval->format('%m months ago');
}

function encrypt_id($id){
	return $id;
}

function decrypt_id($id){
	return $id;
}

function pubDateToMySql($str) {
	return date('Y-m-d H:i:s', strtotime($str));
}


if ( ! function_exists('date_age')){

	function date_age($date){
		
		$datetime1 = date_create($date);
		$datetime2 = date_create(date('Y-m-d H:i:s'));
		$interval = date_diff($datetime1, $datetime2);

		return $interval->format('%a');
		
	}
}

function shorten_dept($dept){
		
	if($dept == 'print3d'){
		return '3D';
	}elseif($dept=='taobao'){
		return 'TB';
	}
	elseif($dept=='tailor'){
		return 'TL';
	}
	elseif($dept=='pcbs'){
		return 'PC';
	}
	elseif($dept=='dirtyprinting'){
		return 'DP';
	}
	elseif($dept=='monthly_box'){
		return 'MB';
	}
	elseif($dept=='items'){
		return 'IT';
	}
	elseif($dept=='tickets'){
		return 'ET';
	}
}

function long_dept($dept){
	if($dept == '3D'){
		return 'print3d';
	}elseif($dept=='TB'){
		return 'taobao';
	}
	elseif($dept=='TL'){
		return 'tailor';
	}
	elseif($dept=='PC'){
		return 'pcbs';
	}
	elseif($dept=='DP'){
		return 'dirtyprinting';
	}
	elseif($dept=='MB'){
		return 'monthly_box';
	}
	elseif($dept=='items'){
		return 'monthly_items';
	}
}

function get_user_id(){

	$CI =& get_instance();
	
	$session = $CI->session->userdata;
	
	$user_id = NULL;
		
	// LOGGED IN 
	
	if(array_key_exists('user_id',$session) AND array_key_exists('logged_in',$session) AND $session['logged_in'] == TRUE){
		$user_id = $session['user_id'];
		
	}else{
		
		$user_id = get_guest_cookie();
		
	}
	
	return $user_id;
	
}

function get_guest_cookie(){
		
	$CI =& get_instance();
	
	$cookies = $_COOKIE;
	$session = $CI->session->userdata;

	//get the unique browser session ID
	$session_id = $session['session_id'];
	
	//If a guest_cookie already exists in a cookie RETURN IT
	if(array_key_exists('guest_cookie',$cookies))
	{
		
		return $cookies['guest_cookie'];
		
	}
	else{
		
		$time = (string)time();
		$random = generateRandomString().'--'.$session_id.'--'.$time;
		
		setcookie('guest_cookie',$random,time()+3600*48,'/');
		
		return $random;
	}
	
}



function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if ( ! function_exists('__parse_hash'))
{
	function __parse_hash($body = NULL,$array = NULL)
	{
		
			if(count($array) > 1){
				foreach($array as $key => $value)
				{
					$body = str_replace('##'.$key.'##',$value,$body);
				}	
			}else{
				$body = str_replace('##'.$key.'##',$value,$body);
			}
			return $body;
		
	}
}

function prettyPrint( $json ){

$result = '';
$level = 0;
$in_quotes = false;
$in_escape = false;
$ends_line_level = NULL;
$json_length = strlen( $json );

for( $i = 0; $i < $json_length; $i++ ) {
    $char = $json[$i];
    $new_line_level = NULL;
    $post = "";
    if( $ends_line_level !== NULL ) {
        $new_line_level = $ends_line_level;
        $ends_line_level = NULL;
    }
    if ( $in_escape ) {
        $in_escape = false;
    } else if( $char === '"' ) {
        $in_quotes = !$in_quotes;
    } else if( ! $in_quotes ) {
        switch( $char ) {
            case '}': case ']':
                $level--;
                $ends_line_level = NULL;
                $new_line_level = $level;
                $char.="<br>";
                for($index=0;$index<$level-1;$index++){$char.="-----";}
                break;

            case '{': case '[':
                $level++;
                $char.="<br>";
                for($index=0;$index<$level;$index++){$char.="-----";}
                break;
            case ',':
                $ends_line_level = $level;
                $char.="<br>";
                for($index=0;$index<$level;$index++){$char.="-----";}
                break;

            case ':':
                $post = " ";
                break;

            case "\t": case "\n": case "\r":
                $char = "";
                $ends_line_level = $new_line_level;
                $new_line_level = NULL;
                break;
        }
    } else if ( $char === '\\' ) {
        $in_escape = true;
    }
    if( $new_line_level !== NULL ) {
        $result .= "\n".str_repeat( "\t", $new_line_level );
    }
    $result .= $char.$post;
}

return $result;
}


function get_file_extension($file_name){
	
	$explode = explode('.',$file_name);
	
	return trim(array_pop($explode));
}


function generate_support_status($status){
	
	$colors['pending'] = '#E3280B';
	$colors['solved'] = '#0C5204';
	$colors['on progress'] = '#0930DE';
	$colors['open'] = '#15854D';
	
	if(array_key_exists($status,$colors)){
		return '<span style="color:'.$colors[$status].'">'.ucwords($status).'</span>';
	}else{
		return '<span style="color:#E3280B">'.ucwords($status).'</span>';
	}
}

function last_12_months($date_format = NULL){
	
	$last_12 =array();
	
	for($i=11;$i>=0;$i--){
		
		$last_12[] = date($date_format,strtotime("-{$i} month"));
		
	}
	
	return ($last_12);
}

function last_20_days($date_format = NULL){
	
	$last_12 =array();

	for($i=20;$i>=0;$i--){
		$last_12[] = date($date_format,strtotime("-{$i} day"));
		
	}
	
	return ($last_12);
}



?>