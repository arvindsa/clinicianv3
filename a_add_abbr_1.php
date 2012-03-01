<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
?>
<?php
require('inc/sql.php');
$full=array();
$full[] = addslashes($_POST['abbr_1']);
$full[] = addslashes($_POST['abbr_2']);

//CHeck if all reqd is there
if(!required($full)){
	header('Location: a_add_abbr.php');
	exit();
}


$sql = "insert into abbreviation (abb_code,abb_full,abb_index) values ('$full[1]','$full[0]','".strtolower($full[1][0])."');";
if(query($sql)){
	echo '<div class="msg success"><span>Abbreviation added</span></div>';	
}


?>