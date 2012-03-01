<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
?>
<?php

require('inc/sql.php');
$full[] = addslashes($_POST['dic_1']);
$full[] = addslashes($_POST['dic_2']);
//CHeck if all reqd is there
if(!required($full)){
	header('Location: a_add_dif.php');
	exit();
}

$sql = "insert into differential (dif_name,dif_desc,dif_index) values ('$full[0]','$full[1]','".strtolower($full[0][0])."');";
if(query($sql)){
	echo '<div class="msg success"><span>Differential entry added</span><div>';	
}


?>