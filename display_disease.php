<?php

require('inc/sql.php');
function proc($str,$column,$table,$idn){
	//Remove space
	$str=trim($str,' :');
	$str=explode(':',$str);
	if(count($str)<0){
		return;
	}
	$str=implode(',',$str);
	if($str==''){
		return;
	}
	$q=query('SELECT '.$column.' AS Data,'.$idn.' AS id FROM '.$table.' where '.$idn.' IN ('.$str.')');
	if(isset($_GET['high']) && $table==$_GET['high']){
		$val=explode(',',$_GET['val']);
		while($r=mysql_fetch_assoc($q)){
			if(in_array($r['id'],$val)){
                 echo '<li><span class="high">'.$r['Data'].'</span></li>';
            }else{
                 echo '<li>'.$r['Data'].'</li>';       
            }			
		}	
	}else{
		while($r=mysql_fetch_assoc($q)){
			echo '<li>'.$r['Data'].'</li>';
		}
	}
}
if(!isset($_GET['id'])){
	die('<div class="msg failure"><span>No data<span></div>');
}

$id=intval($_GET['id']);
$r=query('SELECT * FROM disease INNER JOIN relation ON disease.disease_id=relation.disease_id where disease.disease_id='.$id.'');
if(mysql_num_rows($r)==0){
	die('<div class="msg failure"><span>No disease found</span></div>');
}

$r=mysql_fetch_assoc($r);

//var_dump($r);
echo "<h1>$r[disease_name]</h1>";
if($r['basics']!=''){
echo "<h2>Basics</h2><div class=\"data_tab\">".stripslashes($r['basics'])."</div>";
}//echo "<h2></h2><div class=\"data_tab\">$r[]</div>";
if($r['keynotes']!='')
{echo "<h2>Keynotes</h2><div class=\"data_tab\">".stripslashes($r['keynotes'])."</div>";
}
if($r['lab']!='')
{
echo "<h2>Lab</h2><div class=\"data_tab\">".stripslashes($r['lab'])."</div>";
}
if($r['diagnosis']!='')
{
echo "<h2>Diagnosis</h2><div class=\"data_tab\">".stripslashes($r['diagnosis'])."</div>";
}
if($r['treatement']!='')
{
echo "<h2>Treatment</h2><div class=\"data_tab\">".stripslashes($r['treatement'])."</div>";
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
$query_row=mysql_fetch_array($nw);
$qq =query('SELECT disease_id FROM relation WHERE sym LIKE \'%'.$query_row['sym'].'%\'');
if(mysql_num_rows($qq)==0){
	echo "No disease found"; 
}
//echo 'No of Possibilities = '.mysql_num_rows($qq).'</br>';
$temp=array();
while ($row=mysql_fetch_assoc($qq)){
    if($row['disease_id']!=$id){
        $temp[]=$row['disease_id'];
    }    
}
if(count($temp)>0){
    $str=implode($temp,',');
    $wq = query('SELECT disease_name,disease_id from disease WHERE disease_id IN ('.$str.')');
    while ($row=mysql_fetch_assoc($wq)){
           echo '<h2><a href="display_disease.php?id='.$row['disease_id'].'" class="ajax_call">'.$row['disease_name'].'</a><h2>';
    } 
}else{
    echo "No diseases found";
}
/* 
while ($row = mysql_fetch_array($qq, MYSQL_ASSOC)) {
	$wq = query('SELECT disease_name from disease WHERE disease_id='.$row['disease_id'].'');
	$name = mysql_fetch_array($wq);
	echo '<h2><a href="display_disease.php?id='.$row['disease_id'].'" class="ajax_call">'.$name['disease_name'].'</a><h2>';
}       */
?>

