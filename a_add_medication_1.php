<?php
require('inc/sql.php');

$sql = "insert into medication (med_name,med_cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
