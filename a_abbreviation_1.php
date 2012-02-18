<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

?>
<h1> Abbriviations </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td style="width:250px;"><input name="q" id="q" type="text" style="width:190px; display:block;" />
      <select name="dic" size="25" id="list" style="width:200px;" class="fullh">
          <?php require('tdata/abb.inc'); ?>
        </select></td>
      <td style="vertical-align:top;"><div id="ajax_data"></div></td>
    </tr>
  </table>
</form>
<p> 
  <script>
$('#q').liveUpdate('#list').focus();
bind_list('abbr');
fullh('.fullh');</script> 
</p>
<div id="ajax_target_dic" style="margin-top:20px;"></div>
