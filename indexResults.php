<?php

include 'config.php';
include 'entity.php';
$time_pre = microtime(true);

$cnt = 0;

$connLib = new mysqli(winLibraryServername_1 , winLibraryUsername_1, winLibraryPassword_1, winLibraryDbname_1);  //library connection
mysqli_set_charset($connLib,"utf8");
if ($connLib->connect_error) {
    die("Connection failed: " . $connLib->connect_error);
} 

$libraries=['espa_sellers','ted_sellers','fek_companies','hellastat']; 
$resultArray =[[]];

foreach ($libraries as $libTable){
    $sql = "SELECT * FROM $libTable ".PHP_EOL;
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
                }
                else {
                    #echo $row['vat'].' '.$key.PHP_EOL;
                    $resultArray[$key]['alternate_names'][]=$row['name'];
                }
            }
            
           
            $cnt ++;
            
        }
    }
}
#echo $cnt.PHP_EOL;
#print_r(calculateAppearances($resultArray));
print_r(calculateDistribution(calculateAppearances($resultArray)));

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