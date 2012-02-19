<?php
require('inc/sqlgen.php');
require('inc/sql.php');

//Generate the SQL Query
$q=$_GET['s_id'];
if($q==''){
	header('Location: a_w_sym_1.php?m=Please type atleast one symptom');
	exit;
}
$q=trim($q,',');
$q=explode(',',$q);
if(count($q)==0){
	header('Location: a_w_sym_1.php?m=Please type atleast one symptom');
	exit;
}
$query = new SqlGen("select");
$query->setTable("relation");
$query->addColumn('*');
$qclean=array();
foreach($q as $v){
	if($v!=''){
		$qclean[]=$v;
		$query->setWhere('sym LIKE \'%:'.intval($v).':%\'' ,'AND');
	}
}
$sql = $query->buildQuery();


//Query and check if Rows is more than 0
$c=mysql_query($sql);

if(mysql_num_rows($c)==0){
	header('Location: a_w_sym_1.php?m=Nothing found');
	exit;
}

//redirect automatically if the No of Diseases found is one
if(mysql_num_rows($c)==1){
	$r=mysql_fetch_assoc($c);
	header('Location: display_disease.php?direct=true&id='.$r['disease_id'].'&q='.$_GET['symptom']);
	exit;
}

if(mysql_num_rows($c)>1){
	$dip=array();
	while($r=mysql_fetch_assoc($c)){
			$temp=$r['sym'];
			$temp=explode(':',$temp);
			foreach($temp as $v){
				if($v!='' && !in_array($v,$qclean)){
					$dip[]=$v;
				}
			}
	}
	array_unique($dip);
}
$qr=implode(',',$dip);
$qr= 'select * from symptom where id IN ('.$qr.')';
$qr=mysql_query($qr);

?>
<form id="form1" name="form1" method="post" action="a_w_sym_3.php">
 <h1>Do You have?</h1>
 <div id="format">
  <?php while($d=mysql_fetch_assoc($qr)){?>
  	<div class=" line_label">
    	<input type="checkbox" name="c[<?php echo $d['id'];?>]" id="c_<?php echo $d['id'];?>" />
        <label  for="c_<?php echo $d['id'];?>"><?php echo $d['symptom'];?></label></div>

  <?php
	}?><div class=" line_label">
     <input type="checkbox" name="c_noneother" id="c_noneother" />
        <label  for="c_noneother">No Other Symptoms</label></div>
   <div class=" line_label"> <input type="checkbox" name="c_unsure" id="c_unsure" />
        <label  for="c_unsure">I'm Unsure of other symptoms</label></div>
    </div><?php
	$i=1;
	foreach($qclean as $v){
?>
  <input name="sym_id_<?php echo $i;?>" type="hidden" value="<?php echo $v;?>" />
  <?php $i++;} ?>
  <input name="symptom" type="hidden" value="<?php echo $_GET['symptom'];?>" />
  <div class="center">
          <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
        </div>
</form>
<script type="text/javascript">bind_form();</script>

<!--<div class="msg info"><?php print_r($_GET);?></div>-->