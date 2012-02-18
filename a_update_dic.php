<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');
$sql=mysql_query('SELECT DISTINCT dic_name,dic_id FROM dictionary  GROUP BY dic_name ORDER by dic_name ASC');
$str='';
while($row=mysql_fetch_assoc($sql)){
	$str.= '<option value="'.$row['dic_id'].'">'.$row['dic_name'].'</option>';
}
$h=fopen('tdata/dic.inc','w');
if(fwrite($h,$str)){
	echo 'Dictionary Pool updated';
}else{
	echo 'Dictionary Pool updating failed';
}

?>