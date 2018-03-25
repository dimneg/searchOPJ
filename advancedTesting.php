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

<form action="checkbox-form.php" method="post">
    Do you need wheelchair access?
    <input type="checkbox" name="formWheelchair" value="Yes" />
    <input type="submit" name="formSubmit" value="Submit" />
</form>

<form name="frmSearch" method="post" action="index.php">
	<input type="hidden" id="advance_search_submit" name="advance_search_submit" value="<?php echo $advance_search_submit; ?>">
	<div class="search-box">
		<label class="search-label">With Any One of the Words:</label>
		<div>
			<input type="text" name="search[with_any_one_of]" class="demoInputBox" value="<?php echo $with_any_one_of; ?>"	/>
			<span id="advance_search_link" onClick="showHideAdvanceSearch()">Advance Search</span>
		</div>				
		<div id="advanced-search-box" <?php if(empty($advance_search_submit)) { ?>style="display:none;"<?php } ?>>
			<label class="search-label">With the Exact String:</label>
			<div>
				<input type="text" name="search[with_the_exact_of]" id="with_the_exact_of" class="demoInputBox" value="<?php echo $with_the_exact_of; ?>"	/>
			</div>
			<label class="search-label">Without:</label>
			<div>
				<input type="text" name="search[without]" id="without" class="demoInputBox" value="<?php echo $without; ?>"	/>
			</div>
			<label class="search-label">Starts With:</label>
			<div>
				<input type="text" name="search[starts_with]" id="starts_with" class="demoInputBox" value="<?php echo $starts_with; ?>"	/>
			</div>
			<label class="search-label">Search Keywords in:</label>
			<div>
				<select name="search[search_in]" id="search_in" class="demoInputBox">
					<option value="">Select Column</option>
					<option value="title" <?php if($search_in=="title") { echo "selected"; } ?>>Title</option>
					<option value="description" <?php if($search_in=="description") { echo "selected"; } ?>>Description</option>
				</select>
			</div>
		</div>
		
		<div>
			<input type="submit" name="go" class="btnSearch" value="Search">
		</div>
	</div>
</form>
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