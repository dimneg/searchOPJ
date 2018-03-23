<?php

$array = [
    ['id' => 1, 'db_id'=>'TEDS_2963979','db'=>'yds_big_sellers','name' =>'Oracle Belgium BVBA', 'core'=> 1, 'coreName'=>'Oracle'],
    ['id' => 2, 'db_id'=>'TEDS_3352852','db'=>'yds_big_sellers','name' =>'Oracle Corporation UK Limited', 'core'=> 1, 'coreName'=>'Oracle'],
    ['id' => 3, 'db_id'=>'TEDS_2259837','db'=>'yds_big_sellers','name' =>'Oracle Danmark APS', 'core'=> 1, 'coreName'=>'Oracle'],
    ['id' => 4, 'db_id'=>'TEDS_3019308','db'=>'yds_big_sellers','name' =>'Oracle Hungary Kft.', 'core'=> 1, 'coreName'=>'Oracle'] 
   
];
indexSolr($array);
function indexSolr($array){
    $ch = curl_init("http://83.212.86.164:8983/solr/corporates/update?wt=json");
    foreach ($array as $key => $value) {
          $data = array(
               "add" => array( 
                    "doc" => array(
                         "id"   =>$value['id'],
                         "db_id"   =>$value['db_id'],
                         "db"   =>$value['db'],
                         "name"=>$value['name'],
                         "core"=>$value['core'],
                         "coreName"=>$value['coreName']
                         
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