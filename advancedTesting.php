<html> 

<label for='formCountries[]'>Select option:</label><br>
<select multiple="multiple" name="formCountries[]">
    <option value="GR">Ελλάδα</option>
    <option value="UK">Ηνωμένο Βασίλειο</option>
    
</select>


<p>
What is your Gender?
<select name="formGender">
  <option value="">Select...</option>
  <option value="M">Male</option>
  <option value="F">Female</option>
</select>
</p>

<label for='formCountries[]'>Select the countries that you have visited:</label><br>
<select multiple="multiple" name="formCountries[]">
    <option value="US">United States</option>
    <option value="UK">United Kingdom</option>
    <option value="France">France</option>
    <option value="Mexico">Mexico</option>
    <option value="Russia">Russia</option>
    <option value="Japan">Japan</option>
</select>
<?php

if(isset($_POST['formSubmit']) )
{
  $varMovie = $_POST['formMovie'];
  $varName = $_POST['formName'];
  $varGender = $_POST['formGender'];
  $errorMessage = "";

  // - - - snip - - - 
}

#scenario keyword + country