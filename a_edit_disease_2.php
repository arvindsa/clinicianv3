<?php
function proc($str){
	//Remove space
	$str=trim($str,' ,');
	$str=explode(',',$str);
	$str=':'.implode(':',$str).':';	
	return $str;
}

require('inc/sql.php');
$clean=array();
foreach($_POST['d'] as $k=>$v){
	$clean[$k]=mysql_real_escape_string($v);
}
$id=intval($_POST['id']);
$r=<<<EOF
	UPDATE `disease` SET
	disease_name='$clean[name]',
	keynotes='$clean[keynotes]',
	basics='$clean[basics]',
	lab='$clean[lab]',
	treatement='$clean[treatment]',
	diagnosis='$clean[diagnosis]',
	sex='$clean[sex]',
	age='$clean[age]'
	WHERE disease_id=$id;
EOF;

if(!$r){
	die('SQL ERROR');
}
//UPDATE Relation

$sym=proc($_POST['d']['sym']);
$exa=proc($_POST['d']['exam']);
$pro=proc($_POST['d']['pro']);
$med=proc($_POST['d']['med']);
$cau=proc($_POST['d']['cau']);
$hab=proc($_POST['d']['hab']);
$pre=proc($_POST['d']['pre']);
$r=<<<EOF
	UPDATE `relation` SET
	sym='$sym',
	ex='$exa',
	pro='$pro',
	med='$med',
	cau='$cau',
	hab='$hab',
	pre='$pre'
	WHERE disease_id=$id;
EOF;
if(mysql_query($r)){
	echo '<div class="msg success"><span>Record Modified</span></div>';
}

?>