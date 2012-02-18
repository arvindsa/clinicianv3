
<h1>What are the symptoms?</h1>
<form id="form1" name="form1" method="get" action="a_w_sym_2.php">
  <input type="text" name="symptom" id="symptom" />
  <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div>
</form>
<script type="text/javascript">
	  $("#symptom").autoSuggest("ajax.php", {minChars: 2, selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value"});
					bind_form();</script> 
<?php if(isset($_GET['m'])){echo '<div class="warning msg">'.$_GET['m'].'</div>';}?>