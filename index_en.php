<?php

$search_in_area = '';
$search_in_amount = '';
$crf1 = '';
$crf2 = '';
$crf3 = '';
?>
<html> 
    <header>   
    <h2><center>Discover suppliers in public contracts</center></h2>
  </header>
    <head>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="/sites/all/js/DataTables/media/css/jquery.dataTables.css"> 
        <link rel="stylesheet" type="text/css" href="/sites/all/js/dataTable/jquery-ui/jquery-ui.css" />
        <!-- DataTables JS -->
        <script type="text/javascript" src="/sites/all/js/dataTable/jQuery/jquery-2.0.3.js"></script>
        <script type="text/javascript" src="/sites/all/js/dataTable/jQuery/jquery-ui.js"></script>  
        <script type="text/javascript" charset="utf8"  src="/sites/all/js/dataTable/dataTables/jquery.dataTables1.js"></script> 
        <script type="text/javascript" src="/sites/all/js/dataTable/dataTables/dataTables.sorting.js"></script>
        <script type="text/javascript" src="/sites/all/js/dataTable/date-eu.js"></script>
       <script> 
 	$(document).ready( function () {
 	$('#searchResults').DataTable(
	{
        "aaSorting": [[ 1, "desc" ]], //"aaSorting": [[ 3, "desc" ]],
		"bJQueryUI": true,
		"aLengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
        ],
		
		"oLanguage":{ 	       
		   "sLengthMenu": "Show _MENU_ ",
		   "sZeroRecords": "No records found...",
		   "sInfo": "_START_ - _END_ from _TOTAL_ ",
		   "sInfoEmpty": "No records found",
		   "sInfoFiltered": "(Got a total of _MAX_ entries to show)",
		   "sSearch": "Find:" 
		   },
		    "aoColumnDefs": [ 
						//{  "bVisible": false, "aTargets": [ 3 ] },
						{  "bVisible": false, "aTargets": [ 1 ] },
						//{  "bVisible": false, "aTargets": [ 2 ] }
                        				
					]
		
    } 
	
	
	);
	
	} ); 
</script>
       <script>
		function showHideAdvanceSearch() {
			if(document.getElementById("advanced-search-box").style.display=="none") {
				document.getElementById("advanced-search-box").style.display = "block";
				document.getElementById("advance_search_submit").value= "1";
			} else {
				document.getElementById("advanced-search-box").style.display = "none";
				document.getElementById("crf1").value= "" 
				document.getElementById("crf2").value= "";
				document.getElementById("crf3").value= "";
				document.getElementById("search_in").value= "";
				document.getElementById("advance_search_submit").value= "";
			}
		}
	</script>
       <style>



            li.ex1{
            list-style-type: none;
            display:inline; 
            padding-right: 7px;
            }

            li.ex1:hover {
            color: #30b42b;
            padding-bottom: 1px;
             }

            .general{
            width:80%;
            align:center;
            }

            .mblink:visited, a:visited {
             <!--  color: #609; --> 
            <!--  color: #FFA500;-->
              <!-- color: #1a0dab; --> 
              }
              a:link {
                color: #1a0dab;
            }

            /* visited link */
            a:visited {
                color: #609;
            }
             /* a:link, .w, #prs a:visited, #prs a:active, .q:active, .q:visited, .kl:active, .tbotu {

              <!--  color: #FFA500; -->
               color: #1a0dab; 
            } */
            h1, #cdr_min, #cdr_max, .cpbb, .kpbb, .kprb, .kpgb, .kpgrb, .ksb {
              font-family: arial,sans-serif;
            }


            #wrapNew {
            width: 80%;
            margin: 0 auto;
            background: #99c;
            }
            a {
              padding-left: 0 !important;
            <!--  color: #ffb141; -->
            <!--  color: #609
            } -->


            #mainNew {
            float:left;
            width:75%;
            padding-top:5px;
            padding-bottom:5px;

            }

            #sidebarNew {
            float:right;
            width:25%;
            padding-top:5px;
            padding-bottom:5px;
            }


            #mainNewInternal {
            float:left;
            width:80%;
            padding-top:5px;
            padding-bottom:5px;

            }

            #sidebarNewInternal {
            float:right;
            width:18%;
            padding-top:5px;
            padding-bottom:5px;
            padding-right:5px;

              text-align:center;


              height:10px;
            }





            /* CSSTerm.com Simple CSS menu */

            li.ex2{
            list-style-type: none;
            border-top: solid 1px #E8E8E8;
             height: 47px;
             line-height: 40px;

            }


            .menu_simple ul {
                margin: 0; 
                padding: 0;
                width:220px;
                list-style-type: none;

            }

            .menu_simple ul li a {
                text-decoration: none;
                color: black; 
                padding: 10px 10px;

                display:block;

              border-right: solid 1px #E8E8E8;
              border-left: solid 1px #E8E8E8;
              border-bottom: solid 1px #E8E8E8;

            }

            .menu_simple ul li a:visited {
                color: orange;
            }

            .menu_simple ul li a:hover, .menu_simple ul li .current {
                color: black;
                background-color: #5FD367;
            }

            .imageLi{
            vertical-align:middle;
            }

            .alignleft {
                    float: left;
                   width: 80%;
            }
            .alignright {

                    float: right;
                  padding-right: 30px;
            }

            a.searchTabs:link {
            color: #ffb141; 
            }
            a.searchTabs:visited {
            color: #ffb141; 
            }

            a.searchTabs:hover {
            color: #30b42b;
            }

            a.searchTabs:active {
            color: #1C94C4;
            }
            a.hereTabs{
            font-weight: bold;
            font-size: 125%;

            }
            a.hereTabs:active {
            color: #4285f4;
            }
            a.hereTabs:link {
            color: #4285f4;
            }
            a.hereTabs:hover {
            color: #30b42b;
            }
            a.hereTabs:visited {
            color: #4285f4;
            }
            a.nameLink{
            font-weight: bold;
            }
       <!-- advanced search       -->     
            body{
			 <!--width: 900px;-->
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
			padding: 8px;
                        position: relative;
                        /*left: -80px; */
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Search OPJ</title>
      
           
               <a href="index_en.php"> <img src="languages/images/en.png" alt="english" align="right"> </a>   
               <!-- <a href="index.php?lang=gr"> <img src="languages/images/gr.png" alt="greek" align="right"> </a> -->
               <a href="index.php"> <img src="languages/images/gr.png" alt="greek" align="right"> </a> 
          
</head>
<body>

<div class="row-fluid margin-bottom" align="center" >
<form action="index_en.php" method="post" accept-charset="UTF-8"> 
<p>			
<input type="text" style="width: 450px; height: 32px;" name="formKeyword" placeholder="Vat or Name" value="<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword']?>"  maxlength="70" autofocus /> 			
<input type="submit" name="formSubmit" value="index_en.php"  style="display: none;" >
<p>
    <div>
			<input type="submit" name="Go"  value="Search" action="index_en.php?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'];  else echo $_GET['varKeyword']?>">
                                       <!--   <a class="searchTabs" href="index.php?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword']?>"   >search</a> -->
                                        <!--   <a input type="submit" name="Go" class="btnSearch" value="Search" action="index.php?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'];  else echo $_GET['varKeyword']?>"></a> -->
				</div>
<span id="advance_search_link" onClick="showHideAdvanceSearch()">Advanced Search</span>
									
				<div id="advanced-search-box" <?php if(empty($advance_search_submit)) { ?>style="display:none;"<?php } ?>>
					<label class="search-label">Search with Address:</label>
					<div>
						<input type="text" name="crf1" id="crf1" class="demoInputBox" action="index_en.php"  	/>
					</div>
					<label class="search-label">Search with Postal Code:</label>
					<div>
						<input type="text" name="crf2" id="crf2" class="demoInputBox" value="<?php echo $crf2; ?>"	/>
					</div>
					
					<label class="search-label">Search in:</label>
					<div>
						<select name="advSearch[search_in_area]" id="search_in_area" class="demoInputBox">
							<option value="">Select:</option>
							<option value="Gr" <?php if($search_in_area=="Gr") { echo "selected"; } ?>>GREECE</option>
							<option value="Eu" <?php if($search_in_area=="Eu") { echo "selected"; } ?>>EUROPE</option>
                                                        <option value="Au" <?php if($search_in_area=="Au") { echo "selected"; } ?>>AUSTRALIA</option>
                                                        <option value="Sw" <?php if($search_in_area=="Sw") { echo "selected"; } ?>>SWITZERLAND</option>
                                                        <option value="Dk" <?php if($search_in_area=="Dk") { echo "selected"; } ?>>DENMARK</option>
                                                        <option value="Pp" <?php if($search_in_area=="Pp") { echo "selected"; } ?>>PUBLIC PROCUREMENT</option>
						</select>
					</div>
                                        <label class="amount-label">Amount:</label>
					<div>
						<select name="advSearch[search_in_amount]" id="search_in_amount" class="demoInputBox">
							<option value="">Επιλογή:</option>
							<option value="1" <?php if($search_in_amount=="1") { echo "selected"; } ?>> <2K </option>
							<option value="2" <?php if($search_in_amount=="2") { echo "selected"; } ?>> >2Κ <2M </option>
                                                        <option value="3" <?php if($search_in_amount=="3") { echo "selected"; } ?>> >2M <2B </option>
                                                        <option value="3" <?php if($search_in_amount=="4") { echo "selected"; } ?>> >2B </option>
                                                        
						</select>
					</div>
				</div>
				
				
</p>

</p>
<div align="center" >
 
 <br>
<hr align="center" width="80%">

<li class="ex1" >Results</li>
</div>
</form>
<?php

#print_r($_POST['formKeyword']);
#print_r($_POST['advSearch']);
$advChoiceArea = $_POST['advSearch']['search_in_area'];
$advChoiceAmount = $_POST['advSearch']['search_in_amount'];
#echo $advChoiceArea.' '.$advChoiceAmount.PHP_EOL;   

#adv search variables
#$search_in = "";
#adv search variables

include 'collectData_en.php'; 
include 'keyWord.php';
include 'showResults_en.php'; 
include 'config.php';

$time_pre = microtime(true);
$prefix = '' ;
$varKeyword = $_POST['formKeyword']; 
$rowKeyword = $varKeyword;

$Db='';  
$DesignDoc = '';
$Index ='';
$Limit = 25;
$Sort = 'id';
$Wc = '';
$calls = 0;
$Results = [[]];
$AlreadyFound = 0;
$Boost = 1;
$Actual_link = '';
$Lang = '';
$Domain ='';
$term1 = '';
$term2 = '';
$term12 = '';

$newKeyWord = new keyWord();

if($_POST['formSubmit'] == "index_en.php" || (isset($_GET['varKeyword']))) {   
    if(strlen($varKeyword) != mb_strlen($varKeyword, 'utf-8')){ #not only english     
        $varKeyword = $newKeyWord->prepareKeyword($varKeyword) ;   
    }
    else {
        $varKeyword = rtrim(ltrim($varKeyword));  
    }
    $words = explode(' ', $varKeyword);  

 #read all data
    $search = new collectData();
    if (is_numeric($varKeyword)){ //probaby afm
        if (strlen(utf8_decode($varKeyword)) <=6 ) {
             $search->getAll('',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore );	
        }
        else {
            $search->getAllShort('*',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
        }
    }
    else { #name
        $varKeyword = $newKeyWord->tranlateAbbFull($varKeyword);
        if(strlen($varKeyword) != mb_strlen($varKeyword, 'utf-8')){  #greek found
           if (count($words) === 1){
               if (strlen(utf8_decode($varKeyword)) <= 4 ){ # greek  like
                    $search->getAllGreek('*',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore); 
               }
               else { # exact, fuzzy and then like
                   $search->getAllGreek('',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);  	
                   $search->getAllGreek('~0.75', $varKeyword, DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                   $search->getAllGreek('*',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
               }
           }
           else{
               if (count($words) > 1) {
                   $termsArray = $newKeyWord->prepareExactKeyword($varKeyword);
                   $term1 = $termsArray[0];
                   $term2 = $termsArray[1];
                   $term12 = $termsArray[2];
                   $varKeyword = $termsArray[3];
                   $search->getAllGreek('',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                   $search->getAllGreek('',$term12,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                   if (strlen(utf8_decode($term1)) <=4 ){	
                        $search->getAllGreek('*',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                   }
                   else {
                        $search->getAllGreek('~0.75',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                        $search->getAllGreek('*',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                   }
                   if (strlen(utf8_decode($term2)) <=4 ){	
                       $search->getAllGreek('',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                   }
                   else {
                       $search->getAllGreek('~0.75',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                       $search->getAllGreek('*',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                   }
               }
           }
        }
        else { #english and greek
            if (count($words) == 1){
                if (strlen(utf8_decode($varKeyword)) <=4 ) {
                    $search->getAll('*',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                }
                else {  # latin, >4,1 word : exact-> fuzzy-> like
                     $search->getAll('',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                     $search->getAll('~0.75',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	
                     $search->getAll('*',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);		

                }
            }
            else {
                if (count($words) > 1) {
                    $termsArray = $newKeyWord->prepareExactKeyword($varKeyword);
                    $term1 = $termsArray[0];  
                    $term2 = $termsArray[1];
                    $term12 = $termsArray[2];
                    $varKeyword = rtrim($termsArray[3]);
                    $search->getAll('',$varKeyword,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                    $search->getAll('',$term12,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                    if (strlen(utf8_decode($term1)) <=4 ){
                        $search->getAll('*',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);	  
                    }
                    else {
                        $search->getAll('~0.75',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                        $search->getAll('*',$term1,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                    }
                    if (strlen(utf8_decode($term2)) <=4 ){
                          $search->getAll('',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                    }
                    else {
                        $search->getAll('~0.75',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                        $search->getAll('*',$term2,DbPath,couchUser,couchPass,solrPath,altNamesSolrCore,sparqlServer,corpSolrCore);
                    }

                }
            }
        }

    }
    $resultsPresentation = new showResults();
    
    $resultsPresentation -> presentResults(solrPath, corpSolrCore);
    
    
    $time_post = microtime(true);
    $exec_time = $time_post - $time_pre;
    echo  "<div ALIGN='CENTER'>";
    echo '(In '.number_format($exec_time,2).' seconds)' ;
    echo "</div>";
    $varKeyword =  str_replace('+',' ',$varKeyword);
    $varKeyword =  str_replace('"',' ',$varKeyword);
}

?>

 <html> 
<footer>
<p>  The Open Journalism (OpJ) Project is funded by:
 <img src="logos/inn_fund.png" alt="Innovation Fund" width="108" height="44 "align="middle">
 <img src="logos/dni.png" alt="Digital News Initiative" width="108" height="44" align="middle">
 </p>
</footer>
 </html> 