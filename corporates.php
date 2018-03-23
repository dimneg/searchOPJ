<?php

$array = [
    ['id' => 'or1', 'db_id'=>'TEDS_2963979','source'=>'dataTed','name' =>'Oracle Belgium BVBA', 'core'=> 1, 'coreName'=>'ORACLE'],
    ['id' =>'or2', 'db_id'=>'TEDS_3352852','source'=>'dataTed','name' =>'Oracle Corporation UK Limited', 'core'=> 1, 'coreName'=>'ORACLE'],
    ['id' =>'or3', 'db_id'=>'TEDS_2259837','source'=>'dataTed','name' =>'Oracle Danmark APS', 'core'=> 1, 'coreName'=>'ORACLE'],
    ['id' =>'or4', 'db_id'=>'TEDS_3019308','source'=>'dataTed','name' =>'Oracle Hungary Kft.', 'core'=> 1, 'coreName'=>'ORACLE'], 
    ['id' => 'or5', 'db_id'=>'800420948','source'=>'dataDiaugeia','name' =>'ORACLE ΕΛΛΑΣ ΕΜΠΟΡΙΑ ΛΟΓΙΣΜΙΚΟΥ ΚΑΙ ΣΥΣΤΗΜΑΤΩΝ ΠΛΗΡΟΦΟΡΙΚΗΣ ΜΟΝΟΠΡΟΣΩΠΗ ΕΤΑΙΡΕΙΑ ΠΕΡΙΟΡΙΣΜΕΝΗΣ ΕΥΘΥΝΗΣ ||ORACLE ΕΛΛΑΣ Μ Ε Π Ε ', 'core'=> 1, 'coreName'=>'ORACLE'],
    ['id' => 'or6', 'db_id'=>'094253457','source'=>'dataDiaugeia','name' =>'ORACLE ΕΛΛΑΣ ΑΝΩΝΥΜΗ ΕΜΠΟΡΙΚΗ ΕΤΑΙΡΕΙΑ', 'core'=> 1, 'coreName'=>'ORACLE'], 
    ['id' => 'or7', 'db_id'=>'16957131926','source'=>'dataAustralia','name' =>'ORACLE CORPARTION', 'core'=> 1, 'coreName'=>'Oracle'], 
    ['id' => 'or8', 'db_id'=>'80003074468','source'=>'dataAustralia','name' =>'ORACLE UNIVERSITY', 'core'=> 1, 'coreName'=>'Oracle'], 
    ['id' => 'or9', 'db_id'=>'998476613','source'=>'dataGemh','name' =>'Oracle ανώνυμη εταιρεία λογισμικού χρηματοοικονομικών υπηρεσιών ', 'core'=> 1, 'coreName'=>'ORACLE'], 
    ['id' => 'or10', 'db_id'=>'71474078909','source'=>'dataAustralia','name' =>'ORACLE USER GROUP', 'core'=> 1, 'coreName'=>'ORACLE'], 
    ['id' => 'or11', 'db_id'=>'19063655774','source'=>'dataAustralia','name' =>'ORACLE PTY LIMITED', 'core'=> 1, 'coreName'=>'ORACLE'], 
    ['id' => 'or12', 'db_id'=>'86768265615','source'=>'dataAustralia','name' =>'ORACLE CORPORATION AUSTRALIA PTY LTD', 'core'=> 1, 'coreName'=>'ORACLE'],
    
    ['id' => 'pr1', 'db_id'=>'TEDS_3291647','source'=>'dataTed','name' =>'Pricewaterhousecoopers', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'] ,
    ['id' => 'pr2', 'db_id'=>'TEDS_2086900','source'=>'dataTed','name' =>'PriceWaterhouseCoopers', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr3', 'db_id'=>'TEDS_3182742','source'=>'dataTed','name' =>'Pricewaterhousecoopers', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr4', 'db_id'=>'TEDS_2326952','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr5', 'db_id'=>'TEDS_3121459','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr6', 'db_id'=>'TEDS_2708423','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr7', 'db_id'=>'TEDS_2851400','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'], 
    ['id' => 'pr8', 'db_id'=>'TEDS_2204463','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'],
    ['id' => 'pr9', 'db_id'=>'TEDS_2088190','source'=>'dataTed','name' =>'PricewaterhouseCoopers LLP', 'core'=> 2, 'coreName'=>'PRICE WATER HOUSE'],
    
    ['id' => 'nv1', 'db_id'=>'TEDS_3699892','source'=>'dataTed','name' =>'NOVARTIS FARMACEUTICA,S.A.', 'core'=> 3, 'coreName'=>'NOVARTIS'],
    ['id' => 'nv2', 'db_id'=>'TEDS_3711765','source'=>'dataTed','name' =>'Novartis Finland Oy', 'core'=> 3, 'coreName'=>'NOVARTIS'],
    ['id' => 'nv3', 'db_id'=>'TEDS_3469033','source'=>'dataTed','name' =>'Novartis Healthcare A/S', 'core'=> 3, 'coreName'=>'NOVARTIS']
   
   
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
                         "source"   =>$value['source'],
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