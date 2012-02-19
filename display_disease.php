<?php

require('inc/sql.php');
function proc($str,$column,$table,$idn){
	//Remove space
	$str=trim($str,' :');
	$str=explode(':',$str);
	$str=implode(',',$str);
	$q=query('SELECT '.$column.' AS Data FROM '.$table.' where '.$idn.' IN ('.$str.')');
	while($r=mysql_fetch_assoc($q)){
		echo '<li>'.$r['Data'].'</li>';
	}
}
if(!isset($_GET['id'])){
	die('<div class="msg failure"><span>No data<span></div>');
}

$id=intval($_GET['id']);
$r=query('SELECT * FROM disease INNER JOIN relation ON disease.disease_id=relation.disease_id where disease.disease_id='.$id.'');
if(mysql_num_rows($r)==0){
	die('<div class="msg failure"><span>No disease found</span><div>');
}

$r=mysql_fetch_assoc($r);

//var_dump($r);
echo "<h1>$r[disease_name]</h1>";
if($r['basics']!=''){
echo "<h2>Basics</h2><div class=\"data_tab\">$r[basics]</div>";
}//echo "<h2></h2><div class=\"data_tab\">$r[]</div>";
if($r['keynotes']!='')
{echo "<h2>Keynotes</h2><div class=\"data_tab\">$r[keynotes]</div>";
}
if($r['lab']!='')
{
echo "<h2>Lab</h2><div class=\"data_tab\">$r[lab]</div>";
}
if($r['diagnosis']!='')
{
echo "<h2>Diagnosis</h2><div class=\"data_tab\">$r[diagnosis]</div>";
}
if($r['treatement']!='')
{
echo "<h2>Treatment</h2><div class=\"data_tab\">$r[treatement]</div>";
}
echo "<h2>Sex & Age</h2><div class=\"data_tab\" class=\"case_up\">$r[sex], $r[age]</div>";
echo "<h2>Clinical Presentation</h2><div class=\"data_tab\"><ul>"; proc($r['sym'],'symptom','symptom','id');echo '</ul></div>';
//echo "<h2></h2><div class=\"data_tab\"><ul>"; proc($r[''],'','','');echo '</ul></div>';
echo "<h2>Clinical examination</h2><div class=\"data_tab\"><ul>"; proc($r['ex'],'ex_desc','examination','ex_id');echo '</ul></div>';
echo "<h2>Prognosis</h2><div class=\"data_tab\"><ul>"; proc($r['pro'],'pro_name','prognosis','pro_id');echo '</ul></div>';
echo "<h2>Medication</h2><div class=\"data_tab\"><ul>"; proc($r['med'],'med_name','medication','med_id');echo '</ul></div>';
echo "<h2>Causes</h2><div class=\"data_tab\"><ul>"; proc($r['cau'],'cau_name','causes','cau_id');echo '</ul></div>';
echo "<h2>Habit</h2><div class=\"data_tab\"><ul>"; proc($r['hab'],'hab_name','habbit','hab_id');echo '</ul></div>';
echo "<h2>Predisposition</h2><div class=\"data_tab\"><ul>"; proc($r['pre'],'pre_name','predisposition','pre_id');echo '</ul></div>';

?>
</br>
</br>
<div class="buttons">
<a href="a_edit_disease_1.php?id=<?php echo $id;?>" class="button ajax_call green"><span class="icon icon145"></span><span class="label">Edit Disease</span></a>
</div>
</br>
<?
echo "<h1>POSSIBILITIES</h1>";

$nw = query('SELECT sym FROM relation where disease_id='.$id.'');

if(mysql_num_rows($nw)==0){
	die('<div class="msg failure"><span>No disease found</span><div>');
}
else
{
$query_row=mysql_fetch_array($nw);
//echo strlen($query_row['sym']);
$ex = explode(":",$query_row['sym']);
/*echo $ex[1];
echo $ex[2];
echo $ex[3];
echo $ex[4];
echo $ex[5];
*/
$xx = query('SELECT symptom FROM symptom WHERE id='.$ex[1].'');

$xy = mysql_fetch_array($xx);

echo $xy['symptom'];

}
?>