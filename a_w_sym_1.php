
<h1>What are the symptoms?</h1>
<form id="form1" name="form1" method="get" action="a_w_sym_2.php">
  <input type="text" name="symptom" id="symptom" />
  <div class="center">
    <input type="submit" name="submit" id="submit" value="Search" class="buttonblue" />
  </div>
</form>
<script type="text/javascript">
	  $("#symptom").autoSuggest("ajax.php", {minChars: 2, selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value"});
					bind_form();</script> 
<?php if(isset($_GET['m'])){echo '<div class="warning msg"><span>'.$_GET['m'].'</span></div><p>&nbsp;</p>';}?>

<h1>Search using</h1>
<div class="buttons">
           <a href="a_search_1.php" class="button blue ajax_call"><span class="icon icon198"></span><span class="label">Clinical Examination</span></a>
          <a href="a_wizard_1.php" class="button blue ajax_call"><span class="icon icon194"></span><span class="label">Clinical Presentation</span></a>
           <a href="a_w_prognosis_1.php" class="button blue ajax_call"><span class="icon icon87"></span><span class="label">Prognosis</span></a>
          <a href="a_w_medication_1.php" class="button blue ajax_call"><span class="icon icon150"></span><span class="label">
          Medication</span></a>
           <a href="a_w_causes_1.php" class="button blue ajax_call"><span class="icon icon68"></span><span class="label">Causes</span></a>
                    <a href="a_w_habbit_1.php" class="button blue ajax_call"><span class="icon icon40"></span><span class="label">Habbit</span></a>
          <a href="a_w_predisposition_1.php" class="button blue ajax_call"><span class="icon icon40"></span><span class="label">Predisposition</span></a>
          
      </div>
