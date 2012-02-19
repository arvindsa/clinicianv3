<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');
$sql=mysql_query('SELECT DISTINCT dif_name,dif_id FROM differential ORDER by dif_name ASC');
$str='';
while($row=mysql_fetch_assoc($sql)){
	$str.= '<option value="'.$row['dif_id'].'">'.$row['dif_name'].'</option>';
}
$h=fopen('tdata/dif.inc','w');
if(fwrite($h,$str)){
	echo 'Disease Pool updated';
}else{
	echo 'Disease Pool updating failed';
}

?>