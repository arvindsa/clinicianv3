<?php

/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

if(!isset($_GET['id'])){
	die('<div class="msg failure"><span>No data</span></div>');
}

$did=intval($_GET['id']);
require('inc/sql.php');

$q='SELECT * FROM `differential` WHERE dif_id=\''.$did.'\'';
$q=query($q);
if(mysql_num_rows($q)!=1){
	die('<div class="msg failure"><span>No data</span></div>');
}
$row=mysql_fetch_assoc($q);
		if(isset($_GET['back']) && $_GET['back']=='true'){
			echo '<a href="'.base64_decode($_GET['page']).'" class="ajax_call">Back</a>';
		}
		$spacer='spacer_30';
?>

<h2><?php echo $row['dif_name'];?></h2>
<div><?php echo stripslashes($row['dif_desc']);
echo "<div class=\"".$spacer."\">&nbsp;</div>";?>
</div>
<script type="text/javascript">bind_link();</script>
