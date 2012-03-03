<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');

//Process checkbox
if(isset($_POST['c'])){
	$c=$_POST['c'];
	$c2=array();
	foreach($c as $k=>$v){
		$c2[]=$k;
	}
	$c2=implode(',',$c2);
	//$q=query('SELECT * FROM examination where cat IN ('.$c2.')');
}else{
	//$q=query('SELECT * FROM examination');
}
?>

<?php
    
    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $count=strlen($str);
    echo '<div class="lex" id="lexbind">';
    for($i=0;$i<$count;$i++){
        echo '<a href="ajax_getindex_ex.php?index='.$str[$i].'" class="lex_call">'.$str[$i].'</a>';
    }
    echo '</div>'
?><form action="a_search_3.php" method="post">
	  <table width="100%" border="0">
	    <tr>
	      <td  style="width:50%"><h2>Available symptoms</h2><select name="available" size="30" id="available"  style="width:100%">
         
          </select></td>
	      <td><h2>Selected symptoms</h2>
          
          <select name="selected[]" size="30" id="selected" style="width:100%" multiple="multiple">
          </select><input name="age" type="hidden" value="<?php echo $_POST['age'];?>" />
          <input name="sex" type="hidden" value="<?php echo $_POST['sex'];?>" />
          
</td>
        </tr>
  </table>   <div class="center"> <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div></form>
	  <p>&nbsp; </p><script>bind_slist();bind_form();lex_call();</script>
    <div class="clear"></div>
