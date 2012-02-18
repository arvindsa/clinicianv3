<h1>Type a part of the Disease name</h1><form id="form1" name="form1" method="get" action="a_disease_edit_2.php">
        <input type="text" name="symptom" id="symptom" />
        <div class="center">
          <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
        </div>
      </form>
      <script type="text/javascript">
	  $("#symptom").autoSuggest("ajax_disease.php", {minChars: 2, selectedItemProp: "sym",searchObjProps: "sym",selectedValuesProp:"value",selectionLimit:1});
					bind_form();</script> 
