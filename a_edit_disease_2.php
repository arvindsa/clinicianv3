<?php
function proc($str,$type=''){
	//Remove space
	$str=trim($str,' ,');
	$str=explode(',',$str);
    foreach($str as $k=>$v){
        if(!ctype_digit($v) && $v!=''){
            $id=addextra($v,$type);
            $str[$k]=$id;
        }
        if($v==''){
            unset($str[$k]);
        }
    }
    if(count($str)<1){
        return '';
    }
	$str=':'.implode(':',$str).':';
	return $str;
}

function addextra($v,$type){
    switch ($type){
        case 'sym':
            $sql = "insert into symptom (symptom,cat,sym_index) values ('$v','0','$v[0]');";
            break;
        
        case 'exa':
            $sql = "INSERT INTO `examination` (`ex_desc`, `cat`,`ex_index`) VALUES ('$v',0,'$v[0]');";
            break;
        case 'pro':
            $sql = "insert into prognosis (pro_name,pro_cat,pro_index) values ('$v',0,'$v[0]');";
            break;
        case 'med':
            $sql = "insert into medication (med_name,med_cat,med_index) values ('$v',0,'$v[0]');"; 
            break;
        case 'cau':
            $sql = "insert into causes (cau_name,cau_cat,cau_index) values ('$v',0,'$v[0]');";    
            break;
        case 'hab':
            $sql = "insert into habbit (hab_name,hab_cat,hab_index) values ('$v','0','$v[0]');";   
            break;
        case 'pre':
            $sql = "insert into predisposition (pre_name,pre_cat,pre_index) values ('$v',0,'$v[0]');"; 
            break;
        case 'ris':
            $sql = "insert into risk (ris_name,ris_cat,ris_index) values ('$v',0,'$v[0]');"; 
            break;
        case 'inv':
            $sql = "insert into inv (inv_name,inv_cat,inv_index) values ('$v',0,'$v[0]');"; 
            break;
    }
    mysql_query($sql);
    return mysql_insert_id();
}

require('inc/sql.php');
$clean=array();
foreach($_POST['d'] as $k=>$v){
	$clean[$k]=mysql_real_escape_string($v);
}
$id=intval($_POST['id']);
$r=<<<EOF
	UPDATE `disease` SET
	keynotes='$clean[keynotes]',
    other='$clean[other]',
	basics='$clean[basics]',
	lab='$clean[lab]',
	treatement='$clean[treatment]',
	diagnosis='$clean[diagnosis]',
	sex='$clean[sex]',
	age='$clean[age]'
	WHERE disease_id=$id;
EOF;
if(!mysql_query($r)){
    echo '<div class="msg failure"><span>SQl Error</span></div>';
}

//UPDATE Relation

$sym=proc($_POST['d']['sym'],'sym');
$exa=proc($_POST['d']['exam'],'exa');
$pro=proc($_POST['d']['pro'],'pro');
$med=proc($_POST['d']['med'],'med');
$cau=proc($_POST['d']['cau'],'cau');
$hab=proc($_POST['d']['hab'],'hab');
$pre=proc($_POST['d']['pre'],'pre');
$ris=proc($_POST['d']['ris'],'ris');
$inv=proc($_POST['d']['inv'],'inv');  
$r=<<<EOF
	UPDATE `relation` SET
	sym='$sym',
	ex='$exa',
    inv='$inv',
	pro='$pro',
	med='$med',
	cau='$cau',
	hab='$hab',
    ris='$ris', 
	pre='$pre'
	WHERE disease_id=$id;
EOF;
if(mysql_query($r)){
	echo '<div class="msg success"><span>Record Modified</span></div>';
}

?>