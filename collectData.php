<?php


class collectData {
   function getAll($LuceneOperand,$varKeyword,$DbPath,$couchUser,$couchPass,$solrPath,$solrCore){
       global $Limit;
       #$this->prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);				  
							
       #$this-> prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);       		  
								 
       #$this->prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);
       
       #$this->prepareResults($DbPath,"elod_australia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_australia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);   
	
       #$this->prepareResults($DbPath,"elod_main_orgv4_all","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_main_orgv4_fr","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
 }
   function getAllShort($LuceneOperand,$varKeyword,$DbPath,$couchUser,$couchPass,$solrPath,$solrCore){
       global $Limit;

       #$this->prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);				  
							
       #$this->prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);       		  
								 
       #$this->prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);
       #$this->prepareResults($DbPath,"elod_main_orgv4_all","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_main_orgv4_fr","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
								
			  
			  
      
		  
       #$this->prepareResults($DbPath,"elod_australia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,$Limit,"score",$varKeyword,$couchUser,$couchPass); 
       #$this->prepareResults($DbPath,"elod_australia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,$Limit,"score",$varKeyword,$couchUser,$couchPass);
	
    } 
   function getAllGreek($LuceneOperand,$varKeyword,$DbPath,$couchUser,$couchPass,$solrPath,$solrCore){
       global $Limit;

       #$this->prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);				  
							
       #$this->prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);       		  
								 
       #$this->prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       $this->prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass,$solrPath,$solrCore);
								
     	  
			  
      
       #$this->prepareResults($DbPath,"elod_main_orgv4_all","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
       #$this->prepareResults($DbPath,"elod_main_orgv4_fr","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword,$couchUser,$couchPass);
		  
		
    } 
    
   
   function prepareResults($DbPath,$Db,$DesignDoc,$Index,$Wc,$Limit,$Sort,$varKeyword,$couchUser,$couchPass, $solrPath,$solrCore) {
        global $AlreadyFound;
        $couchUserPwd = $couchUser.':'.$couchPass;
        #echo 'pass = '.$couchUserPwd.PHP_EOL;
        //$GLOBALS['newdata'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $DbPath.$Db."/_design/".$DesignDoc."/".$Index."?q=term:".$varKeyword.$Wc."&limit:".$Limit."&sort:".$Sort);
        echo $DbPath.$Db."/_design/".$DesignDoc."/".$Index."?q=term:".$varKeyword.$Wc."&limit:".$Limit."&sort:".$Sort."<br>";
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $couchUserPwd );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Content-type: application/json; charset=utf-8',
                       'Accept: */*'
                    ));

        $response = curl_exec($ch); 

        curl_close($ch);
        global $prefix ; 
        global $Results;
        global $Lang;   
        
        $json = json_decode($response,true);
        global $Actual_link; 
        global $Lang; 
        $Actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($Actual_link,'/en/') !== false) {
            $Lang= 'en/';
        }
        else
        if (strpos($Actual_link,'/el/') !== false) {
            $Lang= 'el/';
        }
        else $Lang='';

        if (strpos($Actual_link,'83.212.86.162') !== false){
            $Domain = "http://83.212.86.162/";
        }
        else
        if (strpos($Actual_link,'83.212.86.164:81') !== false){
            $Domain = "http://83.212.86.164:81/";
        }
        else
        $Domain = "http://linkedeconomy.org/"; 

        if(isset ($json['rows'])) {
             foreach($json['rows'] as $r){                   
            
                switch ($Db) {
                case "elod_buyers":
                        $prefix=$Domain.$Lang."khmdhs/" ;
                                break;
                case "elod_sellers":
                        $prefix=$Domain.$Lang."khmdhs/" ;
                                break;
                case "elod_diaugeia_buyers":
                        $prefix=$Domain.$Lang."diaugeia/" ;
                                break;
                case "elod_diaugeia_sellers":
                        $prefix=$Domain.$Lang."diaugeia/" ;
                                break;
                case "elod_australia_buyers":
                        $prefix=$Domain.$Lang."australia/" ;
                                break;
                case "elod_australia_sellers":
                        $prefix=$Domain.$Lang."australia/" ;
                                break;  
                case "elod_diaugeia_hybrids":
                        $prefix=$Domain.$Lang."diaugeia/" ;
                                break;  

                case "elod_espa_beneficiaries":
                        $prefix=$Domain.$Lang."" ;
                                break;

                case "elod_main_orgv4_all":
                    $prefix = 'https://www.businessregistry.gr/publicity/show/' ;
                                break;
                case "elod_main_orgv4_fr":
                   $prefix = 'https://www.businessregistry.gr/publicity/show/' ;
                                break;
                }
                global $Boost;
                $Boost = 10;
                switch ($Wc) { //boost step 1
                case "";{	            
                   $r['score'] *=$Boost;
                   break; 
                }
                case "*"; {
                   $r['score'] *=1;
                    break; 

                }
                case "~0.75"; {
                   $r['score'] *=1;
                   break; 
                }
                }
            //echo $Boost;

            if(isset ($json['rows']) && strpos($r['id'], '_') == false && ($this->checkAFM($r['fields']['term'][0]) || strpos($Db, 'australia')== true) ) { //_links and wrong vats exluded for now
                 $newdata =  array (
                 // 'name' => $r['fields']['term'][1],
                      'name' => (isset($r['fields']['term'][1])) ? $r['fields']['term'][1] : null ,            
                      'vat' => $r['fields']['term'][0],
                      'link' => $prefix.$r['id'],
                      'address'=>(isset($r['fields']['address']) ) ? $r['fields']['address'] : null ,
                      'pc'=>(isset($r['fields']['pc']) ) ? $r['fields']['pc'] : null ,   
                      'city'=>(isset($r['fields']['city']) ) ? $r['fields']['city'] : null ,
                      'locality'=>(isset($r['fields']['locality']) ) ? $r['fields']['locality'] : null ,
                      'countryName'=>(isset($r['fields']['countryName']) ) ? $r['fields']['countryName'] : null ,
                      'score' =>  $r['score'],
                      'id' => $r['id'],
                      #'lastUpdate'=> $r['fields']['lastUpdate'],
                      'lastUpdate'=> (isset($r['fields']['lastUpdate']) ) ? $r['fields']['lastUpdate'] : null ,
                     
                   //ΔΙΑΥΓΕΙΑ
                      'award0'=>(isset($r['fields']['awardAmount0']) ) ? $r['fields']['awardAmount0'] : null ,
                      'award1'=> (isset($r['fields']['awardAmount1']) ) ? $r['fields']['awardAmount1'] : null ,
                      'award2'=> (isset($r['fields']['awardAmount2']) ) ? $r['fields']['awardAmount2'] : null ,
                      'awardCnt0'=> (isset($r['fields']['awardCounter0']) ) ? $r['fields']['awardCounter0'] : null ,
                      'awardCnt1'=> (isset($r['fields']['awardCounter1']) ) ? $r['fields']['awardCounter1'] : null ,
                      'awardCnt2'=> (isset($r['fields']['awardCounter2']) ) ? $r['fields']['awardCounter2'] : null ,
                     // 'awardItemsNo'=> $r['fields']['awardItemsNo'], //Not in use
                      'spend0'=> (isset($r['fields']['spendAmount0']) ) ? $r['fields']['spendAmount0'] : null ,
                      'spend1'=> (isset($r['fields']['spendAmount1']) ) ? $r['fields']['spendAmount1'] : null ,
                      'spend2'=> (isset($r['fields']['spendAmount2']) ) ? $r['fields']['spendAmount2'] : null ,
                      'spendCnt0'=>  (isset($r['fields']['spendCounter0']) ) ? $r['fields']['spendCounter0'] : null ,
                      'spendCnt1'=>  (isset($r['fields']['spendCounter1']) ) ? $r['fields']['spendCounter1'] : null ,
                      'spendCnt2'=> (isset($r['fields']['spendCounter2']) ) ? $r['fields']['spendCounter2'] : null ,
                  //'spendingItemsNo'=> $r['fields']['spendingItemsNo'], //Not in use	 	   
                      //ΚΗΜΔΗΣ
                      'contractAmountPrev'=> (isset($r['fields']['contractsAmount0']) ) ? $r['fields']['contractsAmount0'] : null ,
                      'contractAmountCur'=> (isset($r['fields']['contractsAmount1']) ) ? $r['fields']['contractsAmount1'] : null ,
                       // 'contract2'=> $r['fields']['contractsAmount2'],
                      'paymentAmountPrev'=> (isset($r['fields']['paymentsAmount0']) ) ? $r['fields']['paymentsAmount0'] : null ,
                      'paymentAmountCur'=> (isset($r['fields']['paymentsAmount1']) ) ? $r['fields']['paymentsAmount1'] : null ,
                       // 'payment2'=> $r['fields']['paymentsAmount2'], 	  
                      'contractItemsNo'=> (isset($r['fields']['contractItemsNo']) ) ? $r['fields']['contractItemsNo'] : null ,
                      'paymentItemsNo'=>  (isset($r['fields']['paymentItemsNo']) ) ? $r['fields']['paymentItemsNo'] : null ,

                      //australia & London & europa & newyork
                      'contractAmount0'=> (isset($r['fields']['contractAmount0']) ) ? $r['fields']['contractAmount0'] : null ,
                      'contractAmount1'=> (isset($r['fields']['contractAmount1']) ) ? $r['fields']['contractAmount1'] : null ,
                      'contractAmount2'=> (isset($r['fields']['contractAmount2']) ) ? $r['fields']['contractAmount2'] : null ,
                      'contractAmount3'=> (isset($r['fields']['contractAmount3']) ) ? $r['fields']['contractAmount3'] : null , //london only
                      'contractCounter0'=>(isset($r['fields']['contractCounter0']) ) ? $r['fields']['contractCounter0'] : null ,
                      'contractCounter1'=> (isset($r['fields']['contractCounter1']) ) ? $r['fields']['contractCounter1'] : null ,
                      'contractCounter2'=> (isset($r['fields']['contractCounter2']) ) ? $r['fields']['contractCounter2'] : null ,
                      'contractCounter3'=> (isset($r['fields']['contractCounter3']) ) ? $r['fields']['contractCounter3'] : null , //london only

                     

                   //espa  	
                      'SubsContractsAmount'=> (isset($r['fields']['SubsContractsAmount']) ) ? $r['fields']['SubsContractsAmount'] : null ,
                      'SubsPaymentsAmount'=>(isset($r['fields']['SubsPaymentsAmount']) ) ? $r['fields']['SubsPaymentsAmount'] : null ,	
                      'SubsContractsCounter'=>(isset($r['fields']['SubsContractsCounter']) ) ? $r['fields']['SubsContractsCounter'] : null ,
                      'SubsPaymentsCounter'=> (isset($r['fields']['SubsPaymentsCounter']) ) ? $r['fields']['SubsPaymentsCounter'] : null,  
                      'pageKind'=> (isset($r['fields']['pageKind']) ) ? $r['fields']['pageKind'] : null,  
                      
                     
                   #  'altNames'=>(isset($r['fields']['altNames']) ) ? $r['fields']['altNames'] : null, 
                     'altNames'=>  $this->getAltNamesSolr($solrPath, $solrCore, $r['fields']['term'][0]),
                     'gemhDate'=>(isset($r['fields']['Gemhdate']) ) ? $r['fields']['Gemhdate'] : null,
                     'chamber'=>(isset($r['fields']['Chamber']) ) ? $r['fields']['Chamber'] : null,
                     
                     #'dataDiaugeiaBuyers'=>  $this->defineSource($Db, 'dataDiaugeiaBuyers'),
                     #'dataDiaugeiaSellers'=>  $this->defineSource($Db, 'dataDiaugeiaSellers'),
                     'dataDiaugeia'=>  $this->defineSource($Db, 'dataDiaugeia',0),
                     'dataKhmdhs'=>  $this->defineSource($Db, 'dataKhmdhs',0),
                     'dataEspa'=> $this->defineSource($Db, 'dataEspa',0),
                     'dataTed'=>  $this->defineSource($Db, 'dataTed',0),
                     'dataGemh'=>  $this->defineSource($Db, 'dataGemh',0),
                     'dataAustralia'=>$this->defineSource($Db, 'dataAustralia',0),
                     'dataMatched'=>  $this->defineSource($Db, 'dataMatched',0),     
                     
                     'dataDiaugeiaBuyer' => $this->defineProperty($Db,'buyer',0),
                     'dataDiaugeiaSeller' => $this->defineProperty($Db,'seller',0)
                
                     
                );	
            }
            #echo $Db.' '. $this->defineSource($Db, 'dataDiaugeia').PHP_EOL;

            $arrayElements = count($Results);
                    //echo $arrayElements;
                if  ($arrayElements < 2000 && isset($newdata)){
                    $key = $this->searchForId($newdata['vat'], $Results,'vat');
                    if ($key === NULL){
                      $Results[] = $newdata;      
                    }
                    else {
                         echo 'same vat found '.$newdata['vat'].$Db.PHP_EOL;
                         $Results['$key']['dataDiaugeiaBuyer'] = $this->defineSource($Db, 'buyer');
                         $Results['$key']['dataDiaugeia'] = $this->defineSource($Db, 'dataDiaugeia');
                         
                    }
                      
                }
                   
            }

        }
       

        if (!empty($newdata)) {
             $AlreadyFound = 1 ; 
         }
                 
        else {
             $AlreadyFound = 0;
         }
                

    }  
    
   function defineSource($db,$field, $status){
      
       $matchDb = $status;
       
       if (($db == 'elod_buyers' || $db == 'elod_sellers' ) && $field == 'dataKhmdhs'  &&  $matchDb == 0){
          $matchDb = 1;          
       }
       if (($db == 'elod_diaugeia_buyers' || $db == 'elod_diaugeia_sellers' ) && $field == 'dataDiaugeia' &&  $matchDb == 0 ){
           $matchDb =  1;
       }
       
       if (($db == 'elod_espa_beneficiaries' || $db == 'elod_australia_sellers' ) && $field == 'dataAustralia'  &&  $matchDb == 0){
            $matchDb =  1;
       }       
       if ($db == 'elod_australia_buyers'  && $field == 'dataEspa' &&  $matchDb == 0 ){
            $matchDb =  1;
       }
       if ($db == 'Ted'  && $field == 'dataTed' &&  $matchDb == 0){
           $matchDb =  1;
       }
       if ($db == 'elod_main'  && $field == 'dataTed' &&  $matchDb == 0 ){
           $matchDb =  1;
       }
       if (($db == 'elod_main_orgv4_all' || $db == 'elod_main_orgv4_fr' ) && $field == 'dataGemh' &&  $matchDb == 0){
            $matchDb =  1;
       } 
       if ($db == 'solrMatched'  && $field == 'dataMatched' &&  $matchDb == 0){
            $matchDb =  1;
       } 
       return  $matchDb;
      
   } 
   
   function defineProperty($db,$field, $status){
       # $propertiesArray = ['ΦΟΡΕΑΣ','ΑΝΑΔΟΧΟΣ','ΔΙΚΑΙΟΥΧΟΣ'];
       $matchProperty = $status;
       if ($db == 'elod_diaugeia_buyers' && $matchProperty == 0){
          if ($field == 'buyer'){
               $matchProperty = 1;
          }
       }
       if ($db == 'elod_diaugeia_sellers' ){
           if ($field == 'seller' && $matchProperty == 0){
               $matchProperty = 1;
           }
       }
      return $matchProperty;
   }
   function searchForId($id, $array, $index) { 
    foreach ($array as $key => $val) {       
            if ( $val[$index] === $id ) {
                return $key;
                        
            }
                //else echo 'not equal';
     }
        return NULL;
  } 
   function checkAFM($afm) {
   
        if (!preg_match('/^(EL){0,1}[0-9]{9}$/i', $afm))
            return false;
        if (strlen($afm) > 9)
            $afm = substr($afm, 2);

        $remainder = 0;
        $sum = 0;

        for ($nn = 2, $k = 7, $sum = 0; $k >= 0; $k--, $nn += $nn)
            $sum += $nn * ($afm[$k]);
        $remainder = $sum % 11;

        return ($remainder == 10) ? $afm[8] == '0'
                                  : $afm[8] == $remainder;
    }
    
   function getAltNamesSolr($solrPath,$solrCore,$vat){
       $ch = curl_init();
       $url = $solrPath.$solrCore."/select?indent=on&q=id:".$vat."&wt=json";
       $url = str_replace(' ','%20',$url);	
      # echo $url.PHP_EOL;
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_USERPWD, 'dimneg:dim1978');			
       curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type: application/json; charset=utf-8',
	'Accept: */*'
         ));
       
       $response = curl_exec($ch); 
                
       $json = json_decode($response,true);
       curl_close($ch);	
       if (isset ($json['response']['docs'][0]['alt_names']) ){
           # return implode(', ', $json['response']['alt_names']);
           #echo implode(', ', $json['response']['alt_names']);
          # print_r($json['response']['docs'][0]['alt_names']);
            return implode(', ', $json['response']['docs'][0]['alt_names']);
       }
       #return $json;
       
   } 
   
   function getTedDataRDF(){
       $bluebox = curl_init();
   }
}
