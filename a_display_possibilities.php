<?php
require('inc/sqlgen.php');
require('inc/sql.php');

//Generate the SQL Query
$query = new SqlGen("select");
$query->setTable("relation");
$query->addColumn('*');
$q=$_GET['s_id'];
$q=explode(',',$q);
$qclean=array();
foreach($q as $v){
	if($v!=''){
		$qclean[]=$v;
		$query->setWhere('sym LIKE \'%:'.intval($v).':%\'' ,'AND');
	}
}
$sql = $query->buildQuery();


//Query and check if Rows is more than 0
$c=mysql_query($sql);

if(mysql_num_rows($c)==0){
	header('Location: a_wizard_1.php?m=Nothing found');
	exit;
}

//redirect automatically if the No of Diseases found is one
if(mysql_num_rows($c)==1){
	$r=mysql_fetch_assoc($c);
	header('Location: display_disease.php?direct=true&id='.$r['disease_id'].'&q='.$_GET['symptom']);
	exit;
}

if(mysql_num_rows($c)>1){
	$dip=array();
	while($r=mysql_fetch_assoc($c)){
			$dip[]=$r['disease_id'];
	}
	array_unique($dip);
}
$qr=implode(',',$dip);
$qr= 'select disease_name, disease_id from disease where disease_id IN ('.$qr.')';
$qr=mysql_query($qr);
echo '<h1>Possible Diseases</h1>';
while($row=mysql_fetch_assoc($qr)){
	echo '<h2><a href="display_disease.php?id='.$row['disease_id'].'&back=true&page='.base64_encode('a_display_possibilities.php?s_id='.$_GET['s_id']).'" class="ajax_call">'.$row['disease_name'].'</a><h2>';
}
?>


<script type="text/javascript">bind_form();</script>