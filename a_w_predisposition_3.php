<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
require('inc/sql.php');
require('inc/sqlgen.php');
//Generate the SQL Query
$query = new SqlGen("select");
$query->setTable("relation");
$query->addColumn('*');


//Process checkbox
$c=$_POST['selected'];
$c2=array();
foreach($c as $k=>$v){
	$c2[]=$v;
	$query->setWhere('pre LIKE \'%:'.intval($v).':%\'' ,'AND');
}

$sql = $query->buildQuery();
$q=query($sql);
if(mysql_num_rows($q)==0){
	die('No Diseases found');
}
$count_c2=count($c2);

$point_sym=array();
$point_sex=array();
$details=array();
//Caluclate score for matching sqymptoms
while($r=mysql_fetch_assoc($q)){
	$data=array();
	$did=$r['disease_id'];
	$data['p_sym']=0;
	$data['id']=$did;
	$sym=explode(':',trim($r['sym'],':'));
	$data['p_sym']=round(($count_c2/count($sym))*100);

	$q2=query('SELECT disease_name as name, age,sex FROM disease where disease_id=\''.$did.'\' LIMIT 1');
	if(mysql_num_rows($q2)==0){
		die('data error');
	}
	$data['p_sex']=0;
	$data['p_age']=0;
	$q2=mysql_fetch_assoc($q2);
	if(isset($_POST['sex'])){
		if($_POST['sex']==$q2['sex']){
			$data['p_sex']+=10;
		}
	}
	if(isset($_POST['age'])){
			if(intval($q2['age'])!=0){
				$diff=abs(intval($_POST['age'])-intval($q2['age']));
				if($diff==0){
					$data['p_age']+=30;
				}else{
					$data['p_age']+=round(30/($diff));
				}
			}
	}
	$details[$q2['name']]=$data;
}

?>

<table width="100%" border="0" class="data_table">
  <tr>
    <td>Disease name</td>
    <td>Symptom Points</td>
    <td>Age Points</td>
    <td>Sex Points</td>
    <td>Total Points</td>
  </tr>
  <?php
  foreach($details as $k=>$v){?>
    <tr>
    <td><a href="display_disease.php?id=<?php echo $v['id'];?>" class="ajax_call lbox"><?php echo $k;?></a></td>
    <td><?php echo $v['p_sym'];?></td>
    <td><?php echo $v['p_age'];?></td>
    <td><?php echo $v['p_sex'];?></td>
    <td><?php echo $v['p_sex']+$v['p_sym']+$v['p_age'];?></td>
  </tr>
  <?php } ?>
</table>


<script>bind_slist();bind_form();</script>
    <div class="clear"></div>
