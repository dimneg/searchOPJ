<?php

$array = [
    [
        'id' =>'oracle',
        'gr_dia_or'=> '€0.4M (5)',
        'gr_dia_kat'=>'€0.0K (0)',
        'gr_khm_symv'=>'€61.7K (4)',
        'gr_khm_plhr'=>'€72.5K (11)',
        ],
];

indexSolr($array);
function indexSolr($array){
    $ch = curl_init("http://83.212.86.164:8983/solr/corporates_sums/update?wt=json");
    foreach ($array as $key => $value) {
          $data = array(
               "add" => array( 
                    "doc" => array(
                         "id"   =>$value['id'],
                         "gr_dia_or"   =>$value['gr_dia_or'],
                         "gr_dia_kat"   =>$value['gr_dia_kat'],
                         "gr_khm_symv"=>$value['gr_khm_symv'],
                         "gr_khm_plhr'"=>$value['gr_khm_plhr'],
                        
                         
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
