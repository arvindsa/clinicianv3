<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

?>
<h1> Lab investigation</h1> <?php
    
    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $count=strlen($str);
    echo '<div class="lex">';
    for($i=0;$i<$count;$i++){
        echo '<a href="a_lab_1.php?index='.$str[$i].'" class="ajax_call">'.$str[$i].'</a>';
    }
    echo '</div>' ;
    require('inc/sql.php');  
     if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
         $sql='SELECT lab_id,lab_name FROM lab where lab_index=\''.$index.'\' ORDER BY lab_name ASC';
         //die($sql);
         $sql=mysql_query($sql);
         if(mysql_numrows($sql)==0){
             
             die('<div class="msg failure"><span>No Values</span></div>');
         }
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td style="width:350px;"><input name="q" id="q" type="text" style="width:290px; display:block;" />
      <select name="dic" size="25" id="list" style="width:300px;" class="fullh">
          <?php while($row=mysql_fetch_assoc($sql)){
    echo '<option value="'.$row['lab_id'].'">'.$row['lab_name'].'</option>';
} ?>
        </select></td>
      <td style="vertical-align:top;"><div id="ajax_data"></div></td>
    </tr>
  </table>
</form>
<p> 
<script>
$('#q').liveUpdate('#list').focus();
bind_list('lab');
fullh('.fullh');</script> 
</p>
<div id="ajax_target_dis" style="margin-top:20px;"></div>
