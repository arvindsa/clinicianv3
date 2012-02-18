<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');
$sql=mysql_query('SELECT DISTINCT disease_name,disease_id FROM disease ORDER by disease_name ASC');
$str='';
while($row=mysql_fetch_assoc($sql)){
	$str.= '<option value="'.$row['disease_id'].'">'.$row['disease_name'].'</option>';
}
$h=fopen('tdata/dis.inc','w');
if(fwrite($h,$str)){
	echo 'Disease Pool updated';
}else{
	echo 'Disease Pool updating failed';
}

?>