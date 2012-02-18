<?php

$q=$_GET['s_id'];
$q=explode(',',$q);

header('Location: a_edit_disease_1.php?direct=true&id='.$q[0].'&q='.$_GET['symptom']);
exit;
?>