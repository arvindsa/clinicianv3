<?php
require('inc/sqlgen.php');
require('inc/sql.php');

//PArse Checkboxes
$app=true;
$qclean=array();
for($i=1;$app;$i++){
	if(!isset($_POST['sym_id_'.$i])){
		$app=false;
		break;
	}
	$qclean[]=$_POST['sym_id_'.$i];	
}

$qstring='';
$count=count($qclean);
if(!isset($_POST['c_noneother'])){
		for($i=0;$i<$count;$i++){
			$qstring.=' sym LIKE \'%:'.intval($qclean[$i]).':%\' ';
			if($i!=$count-1){
				$qstring.=' AND ';
			}
	}
}else{
	asort($qclean);
	$qstring=' sym =\':'.implode(':',$qclean).':\';';
}
if(!isset($_POST['c_unsure']) && !isset($_POST['c_noneother'])){
	$q1='';
	$count=count($_POST['c']);
	$i=1;
	foreach($_POST['c'] as $v=>$k){
		$q1.=' sym LIKE \'%:'.$v.':%\'';
		$qclean[]=$v;
		if($i<=$count){
			$q1.=' AND ';
		}
	}
}

//Check if the Unsure is checked
if(isset($_POST['c_unsure']) || isset($_POST['c_noneother']) ){
	$q='SELECT disease_id FROM `relation` WHERE '.$qstring;
}else{
	$q='SELECT disease_id FROM `relation` WHERE '.$q1.$qstring;
}

//die($q);
$q=mysql_query($q);
if(mysql_num_rows($q)==0){
	header('Location: a_w_sym_1.php?m=Nothing found');
	exit;	
}
if(mysql_num_rows($q)>1){
	$redir=implode(',',$qclean);
	if(isset($_POST['c_unsure'])){
		header('Location: a_display_possibilities.php?s_id='.$redir);
		exit();
	}
	header('Location: a_w_sym_2.php?redo=true&s_id='.$redir);
	exit();
}
$disease_id=mysql_fetch_assoc($q);
$disease_id=$disease_id['disease_id'];
header('Location: display_disease.php?id='.$disease_id);
exit();

?>