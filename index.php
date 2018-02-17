<html> 
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
                       "sLengthMenu": "Eμφάνιση _MENU_ ",
                       "sZeroRecords": "Δεν βρέθηκαν εγγραφές...",
                       "sInfo": " _START_ - _END_ από _TOTAL_ ",
                       "sInfoEmpty": "Δεν βρέθηκαν εγγραφές",
                       "sInfoFiltered": "(επιλεγμένες από τις _MAX_ εγγραφές)"
                       },
                        "aoColumnDefs": [ 
                                                    //{  "bVisible": false, "aTargets": [ 3 ] },
                                                    {  "bVisible": false, "aTargets": [ 1 ] },
                                            //	{  "bVisible": false, "aTargets": [ 2 ] }

                                            ]

        } 


            );

            } ); 
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


    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Search</title>
</head>
<body>
<div class="row-fluid margin-bottom" align="center" >
<form action="search" method="post" accept-charset="UTF-8"> 
<p>			
<input type="text" style="width: 450px; height: 32px;" name="formKeyword" placeholder="ΑΦΜ ή Όνομα ή Σημείο Πώλησης ή Προϊόν" value="<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword']?>"  maxlength="70" autofocus /> 			
<input type="submit" name="formSubmit" value="search"  style="display: none;" >				
</p>
<div align="center" >
 <!--<li  class="ex1" id="dim" > Δημόσιες Προμήθειες </li><li  class="ex1">Επιδοτήσεις</li> <li  class="ex1">Προϋπολογισμοί</li> <li class="ex1"> Τιμές</li>  -->
<a class="searchTabs" href="searchProcurement?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'] ?>"  >Δημόσιες Προμήθειες</a>
<a class="searchTabs" href="searchCPV?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'] ?>"  >Κατηγορίες Δαπανών</a>
 <a class="searchTabs" href="searchEspa?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'] ?>"    >Επιδοτήσεις</a>
 Προϋπολογισμοί
 <a class="searchTabs" href="searchPrices?varKeyword=<?php if (isset($_POST['formKeyword'])) echo $_POST['formKeyword'] ?>"   >Τιμές</a>
  <!--style="color:#1C94C4" -->
<!--<form method="post" action="searchKhmdhs.php">
    <input type="hidden" name="varKeyword=" value="varKeyword">
    <input type="submit" style="display: none;">
</form> -->
 <br>
<hr align="center" width="80%">
<li class="ex1" >Αποτελέσματα</li> <li class="ex1">Αναζήτησης</li>
</div>
</form>
<?php
$time_pre = microtime(true);
$prefix='' ;
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
$Actual_link ='';
$Lang ='';
$Domain ='';
$term1 = '';
$term2 = '';
$term12 = '';

/
