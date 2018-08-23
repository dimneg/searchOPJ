<?php

include 'config.php';
include 'entity.php';
$time_pre = microtime(true);
$db = 'opj_alt_names';

$cnt = 0;

$connLib = new mysqli(winLibraryServername_1 , winLibraryUsername_1, winLibraryPassword_1, winLibraryDbname_1);  //library connection
mysqli_set_charset($connLib,"utf8");
if ($connLib->connect_error) {
    die("Connection failed: " . $connLib->connect_error);
} 

$libraries=['espa_sellers','ted_sellers','fek_companies','hellastat']; 
$resultArray =[[]];

echo 'source 1 library'.PHP_EOL;
foreach ($libraries as $libTable){
    $sql = "SELECT * FROM $libTable ";
    #echo  $sql;
    $result = $connLib->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (isset ($row['vat']) && $row['vat'] !==''){
                $key = searchForId($row['vat'], $resultArray,'vat');
                if ($key === NULL){
                    $company = new entity();
                    $company->set_name($row['name']);
                    $company->set_vat($row['vat']);
                    $resultArray[$cnt]['name'] = $company->name;
                    $resultArray[$cnt]['vat'] = $company->vat;
                    $resultArray[$cnt]['alternate_names'] = [];
                }
                else {
                    #echo $row['vat'].' '.$key.PHP_EOL;
                    if (!in_array($row['name'], $resultArray[$key]['alternate_names'])){ //for distinct names orelse remove
                         $resultArray[$key]['alternate_names'][]= $row['name'];
                    }
                   
                }
            }
            
           
            $cnt ++;
            
        }
    }
}
$connLib->close();
echo count($resultArray).PHP_EOL;
//source 2 member position
echo 'source 2 member position'.PHP_EOL;
$connGemh =  new MySQLi(gemhDb_host, gemhDb_user, gemhDb_pass, gemhDb_name);
mysqli_set_charset($connGemh,"utf8");
$sql = "select p.vatNumber,p.name as pname, mp.name as mpname from PersonalData p  join MemberPosition  mp on p.id = mp.personID where replace (p.name,' ','') <> replace (mp.name,' ','') and  p.isGsisCompany = 1 group by p.name,mp.name ";
$result = $connGemh->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
         if (isset ($row['vat']) && $row['vat'] !==''){
             $key = searchForId($row['vat'], $resultArray,'vat');
              if ($key === NULL){
                   $company = new entity();
                   $company->set_name($row['pname']);
                   $company->set_vat($row['vatNumber']);
                   $resultArray[$cnt]['name'] = $company->name;
                   $resultArray[$cnt]['vat'] = $company->vat;
                   $resultArray[$cnt]['alternate_names'] = [];
              }
              else {
                   if (!in_array($row['pname'], $resultArray[$key]['alternate_names'])){ //for distinct names orelse remove
                       $resultArray[$key]['alternate_names'][] = $row['name'];
                   }
              }
         }
         $cnt ++;
    }
}
echo count($resultArray).PHP_EOL;
$connGemh->close();
//
//
#echo $cnt.PHP_EOL;
#print_r(calculateAppearances($resultArray));
#print_r(calculateDistribution(calculateAppearances($resultArray)));
#print_r($resultArray);

#saveCsvCloud($resultArray, 'entities.csv');
#saveCsvCloud(calculateAppearances($resultArray), 'appearences.csv');
#saveCsvCloud(calculateDistribution(calculateAppearances($resultArray), 'distribution.csv'));
#print_r(calculateDistribution(calculateAppearances($resultArray)));
#indexSolr($resultArray);
$couchUserPwd = couchUser.':'.couchPass;
$ch = curl_init();

indexCouch($resultArray,$ch,$couchUserPwd,$db);

$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo '(In '.number_format($exec_time/60,2).' mins)'.PHP_EOL ;

function searchForId($id, $array,$index) { 
    foreach ($array as $key => $val) {       
            if ( $val[$index] === $id ) {
                return $key;
                        
            }
                //else echo 'not equal';
     }
        return NULL;
} 

function calculateAppearances($array){
    $appearencesArray = [[]];
    $cnt = 0;
    foreach ($array as $key => $row) {
        if (isset($row['alternate_names'])){
             if (count($row['alternate_names']) > 1) {
                  $appearencesArray[$cnt]['vat'] = $row['vat'];
                  $appearencesArray[$cnt]['countNames'] = count($row['alternate_names']);
                  $cnt++;
                  #echo $row['vat'].' '.count($row['alternate_names']).PHP_EOL;
            }
        }
        
    }
    return $appearencesArray;
}

function calculateDistribution($array){
    $distributionArray = [[]];
    $cnt = 0;
    foreach ($array as $key => $val){
     
            $key = searchForId($val['countNames'], $distributionArray,'value');
            if ($key === NULL){
                $distributionArray[$cnt]['value'] = $val['countNames'];
                $distributionArray[$cnt]['distributionValue'] = 1;
            }
            else {
                $distributionArray[$key]['distributionValue']++;
            }
         $cnt++;
    }
    return $distributionArray;
}
function indexCouch($resultArray,$ch,$couchUserPwd,$db){
    
     foreach ($resultArray as $key => $value) {
        if (!empty($value['alternate_names'])){
             $id = $value['vat'];
             echo   $id.PHP_EOL;
             $file_contents = json_encode($value,JSON_UNESCAPED_UNICODE); 
             curl_setopt($ch, CURLOPT_URL, 'http://83.212.86.158:5984/'.$db.'/'.$id);
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); /* or PUT */
             curl_setopt($ch, CURLOPT_POSTFIELDS, $file_contents);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_USERPWD, $couchUserPwd );
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-type: application/json',
                        'Accept: */*'
         ));
         $response = curl_exec($ch); 
        }
       
     }
}

function indexSolr($resultArray){
    $ch = curl_init("http://83.212.86.164:8983/solr/alt_names/update?wt=json");
    foreach ($resultArray as $key => $value) {
          $data = array(
               "add" => array( 
                    "doc" => array(
                         "id"   =>$value['vat'],
                          "name"=>$value['name'],
                          "alt_names"=>$value['alternate_names']
                        ),
                   "commitWithin" => 1000,
                    ),
               );
            $data_string = json_encode($data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    $response = curl_exec($ch);
    print_r($response); 
    }
    
    
    curl_close($ch);
    
}


    

function saveCsvCloud($tableName,$fileName){
	$fp = fopen($fileName, 'w');

	foreach ($tableName as $fields) {
            fputcsv($fp, $fields,"~");		
	}

	fclose($fp);	
    }
