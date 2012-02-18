<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
?>
<h1> Add a new abbreviation </h1>
<form id="form2" method="post" action="a_add_abbr_1.php">
  <table width="100%" border="0">
    <tr>
      <td style="width:150px;"><h2> Full Form:</h2></td>
      <td><input type="text" class="fullw" name="abbr_1" id="abbr_1" /></td>
    </tr>
    <tr>
      <td><h2> Abbreviation: </h2></td>
      <td><input type="text" name="abbr_2" class="fullw" id="abbr_2" /></td>
    </tr>
  </table>
  <center>
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Save" />
  </center>
</form>
<script>
bind_form();</script> 