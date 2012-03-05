<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
error_reporting(0);
mysql_connect('localhost','root','usbw');
mysql_select_db('clinician');

function query($str){
	$query=mysql_query($str);
	if(!$query){
		echo $str.'<hr>';
		die('SQL ERROR: '.mysql_error());
	}
	return $query;
}

function required($a){
	if(!is_array($a)){
		return false;
	}
	foreach($a as $k=>$v){
		if($v==''){
			return false;
		}
	}
	return true;
}

?>