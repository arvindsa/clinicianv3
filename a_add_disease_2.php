<?php
function proc($str){
	//Remove space
	$str=trim($str,' ,');
	$str=explode(',',$str);
	$str=':'.implode(':',$str).':';	
	return $str;
}

require('inc/sql.php');


$r= mysql_query('INSERT INTO `disease` (`disease_id`, `disease_name`, `keynotes`, `basics`, `lab`, `treatement`, `diagnosis`, `sex`, `age`) VALUES (NULL, \''.mysql_real_escape_string($_POST['d']['name']).'\', \''.mysql_real_escape_string($_POST['d']['keynotes']).'\', \''.mysql_real_escape_string($_POST['d']['basics']).'\', \''.mysql_real_escape_string($_POST['d']['lab']).'\', \''.mysql_real_escape_string($_POST['d']['treatment']).'\', \''.mysql_real_escape_string($_POST['d']['diagnosis']).'\', \''.mysql_real_escape_string($_POST['d']['sex']).'\', \''.mysql_real_escape_string($_POST['d']['age']).'\');');

if(!$r){
	die('SQL ERROR');
}
$id=mysql_insert_id();

$r=mysql_query('INSERT INTO `relation` (`disease_id`, `sym`, `ex`, `pro`, `med`, `cau`, `hab`, `pre`) VALUES (\''.$id.'\', \''.proc($_POST['d']['sym']).'\', \''.proc($_POST['d']['exam']).'\', \''.proc($_POST['d']['pro']).'\', \''.proc($_POST['d']['med']).'\', \''.proc($_POST['d']['cau']).'\', \''.proc($_POST['d']['hab']).'\', \''.proc($_POST['d']['pre']).'\');');

if($r){
	echo 'Data added';
}

?>