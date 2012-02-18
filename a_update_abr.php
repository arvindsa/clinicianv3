<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');
$sql=mysql_query('SELECT DISTINCT abb_id,abb_code FROM abbreviation  GROUP BY abb_code ORDER by abb_code ASC');
$str='';
while($row=mysql_fetch_assoc($sql)){
	$str.= '<option value="'.$row['abb_id'].'">'.$row['abb_code'].'</option>';
}
$h=fopen('tdata/abb.inc','w');
if(fwrite($h,$str)){
	echo 'Abbreviation Pool updated';
}else{
	echo 'Abbreviation Pool updating failed';
}

?>