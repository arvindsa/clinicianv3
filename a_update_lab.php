<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');
$sql=mysql_query('SELECT DISTINCT lab_name,lab_id FROM lab ORDER by lab_name ASC');
$str='';
while($row=mysql_fetch_assoc($sql)){
	$str.= '<option value="'.$row['lab_id'].'">'.$row['lab_name'].'</option>';
}
$h=fopen('tdata/lab.inc','w');
if(fwrite($h,$str)){
	echo 'Lab Pool updated';
}else{
	echo 'Lab Pool updating failed';
}

?>