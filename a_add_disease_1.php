<form action="a_add_disease_2.php" method="post" name="add_d">
  <h1>Add a Disease </h1>
  <label><span>Disease name:</span>
    <input name="d[name]" type="text" class="fullw">
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
    <textarea name="d[keynotes]" cols="" rows="" class="fullw"></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Basics</span>

    <textarea name="d[basics]" cols="" rows="" class="fullw"></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Lab</span>

    <textarea name="d[lab]" cols="" rows="" class="fullw"></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Treatment</span>

    <textarea name="d[treatment]" cols="" rows="" class="fullw"></textarea>
  </label>
  <div class="spacer_30"></div>
  <label><span>Diagnosis</span>

    <textarea name="d[diagnosis]" cols="" rows="" class="fullw"></textarea>
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Age</span>

    <textarea name="d[age]" cols="" rows="" class="fullw"></textarea>
  </label>
  
  <div class="spacer_30"></div>
  <label><span>Sex</span>

    <textarea name="d[sex]" cols="" rows="" class="fullw"></textarea>
  </label>
  
  
  
  
  
  
  <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div>
</form>
<script type="text/javascript">
  $("#symptom").autoSuggest("ajax_add_sym.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[sym]"});
  $("#exam").autoSuggest("ajax_add_exam.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[exam]"});
  $("#pro").autoSuggest("ajax_add_pro.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[pro]"});
  $("#med").autoSuggest("ajax_add_med.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[med]"});
  $("#cau").autoSuggest("ajax_add_cau.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[cau]"});
  $("#pre").autoSuggest("ajax_add_pre.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[pre]"});
  $("#hab").autoSuggest("ajax_add_hab.php", {selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",inpName:"d[hab]"});
  bind_form();
</script>