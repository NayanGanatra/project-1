<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');







$config['base_url']	= ''; // your website url



$config['rootfolderpath'] = "spcsusa/"; // Your website root directory path


$config['convention_folder']	= '2014_washington/';
$config['convention_db_prefix']	= 'con_';
$config['convention_folder_with_slash']	= '2014/washington/';


/*pradip_update20141008_for texas convention start*/ 
$config['convention_texas_folder']	= '2015_texas/';
$config['convention_texas_db_prefix']	= 'con_texas_';
$config['convention_texas_folder_with_slash']	= '2015/texas/';
/*pradip_update20141008_for texas convention end*/ 



$config['index_page'] = 'index.php';







/*



| 'AUTO'			Default - auto detects



| 'PATH_INFO'		Uses the PATH_INFO



| 'QUERY_STRING'	Uses the QUERY_STRING



| 'REQUEST_URI'		Uses the REQUEST_URI



| 'ORIG_PATH_INFO'	Uses the ORIG_PATH_INFO



*/



$config['uri_protocol']	= 'PATH_INFO';







$config['url_suffix'] = '.html';







$config['language']	= 'english';







$config['charset'] = 'UTF-8';







$config['enable_hooks'] = FALSE;







$config['subclass_prefix'] = 'MY_';







$config['permitted_uri_chars'] = 'a-z 0-9~%.:_@\-';







$config['allow_get_array']		= TRUE;



$config['enable_query_strings'] = FALSE;



$config['controller_trigger']	= 'c';



$config['function_trigger']		= 'm';



$config['directory_trigger']	= 'd'; // experimental not currently in use







$config['log_threshold'] = 0;







$config['log_path'] = '';







$config['log_date_format'] = 'Y-m-d H:i:s';







$config['cache_path'] = '';







$config['encryption_key'] = 'abcdefghijklmnopqrstuvwxyz1234567890';







$config['sess_cookie_name']		= 'ci_session';



$config['sess_expiration']		= 7200;



$config['sess_expire_on_close']	= FALSE;



$config['sess_encrypt_cookie']	= FALSE;



$config['sess_use_database']	= FALSE;



$config['sess_table_name']		= 'ci_sessions';



$config['sess_match_ip']		= FALSE;



$config['sess_match_useragent']	= TRUE;



$config['sess_time_to_update']	= 300;







$config['cookie_prefix']	= "";



$config['cookie_domain']	= "";



$config['cookie_path']		= "/";



$config['cookie_secure']	= FALSE;







$config['global_xss_filtering'] = FALSE;







$config['csrf_protection'] = FALSE;



$config['csrf_token_name'] = 'csrf_test_name';



$config['csrf_cookie_name'] = 'csrf_cookie_name';



$config['csrf_expire'] = 7200;







$config['compress_output'] = FALSE;







$config['time_reference'] = 'local';







$config['rewrite_short_tags'] = FALSE;







$config['proxy_ips'] = '';







/* Basic Function */



/*function friendlyURL($string){



	$string = preg_replace("`\[.*\]`U","",$string);



	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);



	$string = htmlentities($string, ENT_COMPAT, 'utf-8');



	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );



	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);



	return strtolower(trim($string, '-'));



}

function friendlyURL_user($string)

	{



		$string = preg_replace("`\[.*\]`U","",$string);

	

		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);

	

		$string = htmlentities($string, ENT_COMPAT, 'utf-8');

	

		$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );

	

		//$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);

		$string = preg_replace( array("`[^.-_a-z0-9]`i","`[-]+`") , "-", $string);

		 

	

		return strtolower(trim($string, '-'));



	}



/* End of file config.php */



/* Location: ./application/config/config.php */



