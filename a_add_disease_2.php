<?php
function proc($str){
	//Remove space
	$str=trim($str,' ,');
	$str=explode(',',$str);
	$str=':'.implode(':',$str).':';	
	return $str;
}

require('inc/sql.php');


$r= mysql_query('INSERT INTO `disease` (disease_name) VALUES (\''.mysql_real_escape_string($_POST['d']['name']).'\');');

if(!$r){
	die('SQL ERROR');
}
$id=mysql_insert_id();

$r=mysql_query('INSERT INTO `relation` (`disease_id`) VALUES (\''.$id.'\');');

if($r){
	header('Location: a_edit_disease_1.php?id='.$id);
    exit;
}

?>