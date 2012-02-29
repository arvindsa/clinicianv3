<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
?>
<h1> Add a new Differential Diagnosis entry</h1>
<form id="form2" method="post" action="a_add_dif_1.php">
  <table width="100%" border="0">
    <tr>
      <td style="width:150px;"><h2> Word:</h2></td>
      <td><input type="text" name="dic_1" id="dic_1" class="fullw"></td>
    </tr>
    <tr>
      <td><h2>Description: </h2></td>
      <td><textarea name="dic_2" id="dic_2" class="fullw" style="height:100px;"> </textarea></td>
    </tr>
  </table>
  <center>
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Save" />
  </center>
</form>
<script>$("textarea").cleditor({
          width:        "100%", // width not including margins, borders or padding
          height:       250, // height not including margins, borders or padding
          controls:     // controls to add to the toolbar
                        "bold italic underline strikethrough subscript superscript | font size " +
                        "style | color highlight removeformat | bullets numbering | outdent " +
                        "indent | alignleft center alignright justify"});
bind_form();</script> 