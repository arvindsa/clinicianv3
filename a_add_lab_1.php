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
	header('Location: a_add_lab.php');
	exit();
}

$sql = "insert into lab (lab_name,lab_desc,lab_index) values ('$full[0]','$full[1]','".strtolower($full[0])."');";
if(query($sql)){
	echo '<div class="msg success"><span>DifferentialLab Investigation entry added</span></div>';	
}


?>