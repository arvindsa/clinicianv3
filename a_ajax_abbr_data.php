<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

if(!isset($_GET['id'])){
	header('Location: a_abbreviation_1.php');
	exit();
}
$did=intval($_GET['id']);
require('inc/sql.php');

$q='SELECT * FROM `abbreviation` WHERE abb_id=\''.$did.'\'';
$q=query($q);
if(mysql_num_rows($q)!=1){
	header('Location: a_abbreviation_1.php');
	exit();
}
$row=mysql_fetch_assoc($q);
		if(isset($_GET['back']) && $_GET['back']=='true'){
			echo '<a href="'.base64_decode($_GET['page']).'" class="ajax_call">Back</a>';
		}
		$spacer='spacer_30';
?>
<h2><?php echo $row['abb_code'];?></h2>
<div><?php echo $row['abb_full'];
echo "<div class=\"".$spacer."\">&nbsp;</div>";?></div>
