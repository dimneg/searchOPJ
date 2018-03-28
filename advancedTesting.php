<html>
	<head>
	<title>Advanced Search using PHP</title>
	<style>
		body{
			width: 600px;
			font-family: "Segoe UI",Optima,Helvetica,Arial,sans-serif;
			line-height: 25px;
		}
		.search-box {
			padding: 30px;
			background-color:#C8EEFD;
		}
		.search-label{
			margin:2px;
		}
		.demoInputBox {    
			padding: 10px;
			border: 0;
			border-radius: 4px;
			margin: 0px 5px 15px;
			width: 250px;
		}
		.btnSearch{    
			padding: 10px;
			background: #84D2A7;
			border: 0;
			border-radius: 4px;
			margin: 0px 5px;
			color: #FFF;
			width: 150px;
		}
		#advance_search_link {
			color: #001FFF;
			cursor: pointer;
		}
		.result-description{
			margin: 5px 0px 15px;
		}
	</style>
	<script>
		function showHideAdvanceSearch() {
			if(document.getElementById("advanced-search-box").style.display=="none") {
				document.getElementById("advanced-search-box").style.display = "block";
				document.getElementById("advance_search_submit").value= "1";
			} else {
				document.getElementById("advanced-search-box").style.display = "none";
				document.getElementById("with_the_exact_of").value= "";
				document.getElementById("without").value= "";
				document.getElementById("starts_with").value= "";
				document.getElementById("search_in").value= "";
				document.getElementById("advance_search_submit").value= "";
			}
		}
	</script>
	</head>
	<body>
		<h2>Advanced Search using PHP</h2>
    <div>      
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
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<div>
				<div><strong><?php echo $row["title"]; ?></strong></div>
				<div class="result-description"><?php echo $row["description"]; ?></div>
			</div>
			<?php } ?>
		</div>
	</body>
</html>