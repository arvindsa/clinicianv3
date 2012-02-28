<?php
if(!isset($_GET['id'])){die('Error');}
$id=intval($_GET['id']);
require('inc/sql.php');
$r=query('SELECT * FROM disease INNER JOIN relation ON disease.disease_id=relation.disease_id where disease.disease_id='.$id.'');
if(mysql_num_rows($r)==0){
	die('No disease found');
}
$r=mysql_fetch_assoc($r);
function proc($str,$column,$table,$idn){
    if($str==''){
        return;
    }
	//Remove space
	$str=trim($str,' :');
	$str=explode(':',$str);
	if(count($str)==0){return;}
	$str=implode(',',$str);
	$q=query('SELECT '.$idn.' AS id, '.$column.' AS Data FROM '.$table.' where '.$idn.' IN ('.$str.')');
	;
	$data=array();
	while($r=mysql_fetch_assoc($q)){
		$array=array();
		$array['sym']=$r['Data'];
		$array['value']=$r['id'];
		$data[]=$array;
	}
	echo ',preFill:'.json_encode($data);
}
?>
<form action="a_edit_disease_2.php" method="post" name="add_d">
<input name="id" type="hidden" value="<?php echo $id; ?>" />

<div id="textare_coll">

  <h1>Add a Disease </h1>
  <label><span>Disease name:</span>
    <input name="d[name]" type="text" class="fullw" value="<?php echo $r['disease_name'];?>">
  </label>
  <div class="spacer_30"></div>
  <label><span>Clinical Presentation</span>
    <input type="text" name="symptom" id="symptom" />
  </label>
  <div class="spacer_30"></div>
  <label><span>Clinical Examination</span>
    <input type="text" name="exam" id="exam" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Prognosis</span>
    <input type="text" name="pro" id="pro" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Medication</span>
    <input type="text" name="med" id="med" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Causes</span>
    <input type="text" name="cau" id="cau" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Habit</span>
    <input type="text" name="hab" id="hab" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Predisposition</span>
    <input type="text" name="pre" id="pre" />
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Keynotes</span>
    <textarea name="d[keynotes]" cols="" rows="" class="fullw"><?php echo $r['keynotes'];?></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Basics</span>

    <textarea name="d[basics]" cols="" rows="" class="fullw"><?php echo $r['basics'];?></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Lab</span>

    <textarea name="d[lab]" cols="" rows="" class="fullw"><?php echo $r['lab'];?></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Treatment</span>

    <textarea name="d[treatment]" cols="" rows="" class="fullw"><?php echo $r['treatement'];?></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Diagnosis</span>

    <textarea name="d[diagnosis]" cols="" rows="" class="fullw"><?php echo $r['diagnosis'];?></textarea>
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Age</span>

    <textarea name="d[age]" cols="" rows="" class="fullw"><?php echo $r['age'];?></textarea>
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Sex</span>
    <textarea name="d[sex]" cols="" rows="" class="fullw"><?php echo $r['sex'];?></textarea>
  </label>
  
  
</div>  
  
  
  
  <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div>
</form>
<script type="text/javascript">
var fill={items: [
{'value': "21", 'sym': "Mick Jagger"}
]};
  $("#symptom").autoSuggest("ajax_add_sym.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[sym]"<?php proc($r['sym'], 'symptom','symptom','id');?>});
  $("#exam").autoSuggest("ajax_add_exam.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[exam]"<?php proc($r['ex'],'ex_desc','examination','ex_id');?>});
  $("#pro").autoSuggest("ajax_add_pro.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[pro]"<?php proc($r['pro'],'pro_name','prognosis','pro_id');?>});
  $("#med").autoSuggest("ajax_add_med.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[med]"<?php proc($r['med'],'med_name','medication','med_id');?>});
  $("#cau").autoSuggest("ajax_add_cau.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[cau]"<?php proc($r['cau'],'cau_name','causes','cau_id');?>});
  $("#pre").autoSuggest("ajax_add_pre.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[pre]"<?php proc($r['hab'],'hab_name','habbit','hab_id');?>});
  $("#hab").autoSuggest("ajax_add_hab.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[hab]"<?php proc($r['pre'],'pre_name','predisposition','pre_id');?>});
  
  $("#textare_coll textarea").cleditor({
          width:        "100%", // width not including margins, borders or padding
          height:       250, // height not including margins, borders or padding
          controls:     // controls to add to the toolbar
                        "bold italic underline strikethrough subscript superscript | font size " +
                        "style | color highlight removeformat | bullets numbering | outdent " +
                        "indent | alignleft center alignright justify"});
  bind_form();
</script>