<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexSearch
 *
 * @author dimitris negkas
 */
include 'config.php';
class indexSearch {
   function getAll($LuceneOperand,$varKeyword,$DbPath){
       global $Limit;
       $this->prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       $this-> prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);				  
							
       $this-> prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       $this->prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);       		  
								 
       $this->prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       $this->prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
								
       $this->prepareResults($DbPath,"elod_eprices_shops","Shop","by_eprices_ShopName",$LuceneOperand,25,"score",$varKeyword);
       $this->prepareResults($DbPath,"elod_eprices_products","Product","by_eprices_ProductName",$LuceneOperand,25,"score",$varKeyword);
       $this->prepareResults($DbPath,"elod_kath_products","Product","by_eprices_ProductName",$LuceneOperand,25,"score",$varKeyword); 
       $this->prepareResults($DbPath,"elod_fuel_prices_products","Product","by_fuelPrices_ProductName",$LuceneOperand,50,"score",$varKeyword);
   }
   
   function getAllGreek($LuceneOperand,$varKeyword,$DbPath){
       global $Limit;

       prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);				  
							
       prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);       		  
								 
       prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
								
       prepareResults($DbPath,"elod_eprices_shops","Shop","by_eprices_ShopName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_eprices_products","Product","by_eprices_ProductName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_kath_products","Product","by_eprices_ProductName",$LuceneOperand,25,"score",$varKeyword); 
       prepareResults($DbPath,"elod_fuel_prices_products","Product","by_fuelPrices_ProductName",$LuceneOperand,50,"score",$varKeyword);
       #prepareResults($DbPath,"elod_fuel_prices_shops","Shop","by_fuelprices_ShopName",$LuceneOperand,25,"score",$varKeyword);			  
			  
       prepareResults($DbPath,"elod_cpv","CPV","by_cpvName",$LuceneOperand,50,"score",$varKeyword);
		  
		
    }
    
   function getAllShort($LuceneOperand,$varKeyword,$DbPath){
       global $Limit;

       prepareResults($DbPath,"elod_diaugeia_hybrids","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_espa_beneficiaries","VatIdOrName","by_beneficiaryDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);				  
							
       prepareResults($DbPath,"elod_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_diaugeia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);       		  
								 
       prepareResults($DbPath,"elod_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
       prepareResults($DbPath,"elod_diaugeia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,25,"score",$varKeyword);
								
			  
			  
       prepareResults($DbPath,"elod_cpv","CPV","by_cpvName",$LuceneOperand,50,"score",$varKeyword);
		  
       prepareResults($DbPath,"elod_australia_buyers","buyerVatIdOrName","by_buyerDtls_VatIdOrName",$LuceneOperand,$Limit,"score",$varKeyword); 
       prepareResults($DbPath,"elod_australia_sellers","sellerVatIdOrName","by_sellerDtls_VatIdOrName",$LuceneOperand,$Limit,"score",$varKeyword);
	
    } 
    
   function prepareResults($DbPath,$Db,$DesignDoc,$Index,$Wc,$Limit,$Sort,$varKeyword) {
        global $AlreadyFound;
        $couchUserPwd = ".couchUser.':'.couchPass.";
        
        //$GLOBALS['newdata'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $DbPath.$Db."/_design/".$DesignDoc."/".$Index."?q=term:".$varKeyword.$Wc."&limit:".$Limit."&sort:".$Sort);
        //echo $DbPath.$Db."/_design/".$DesignDoc."/".$Index."?q=term:".$varKeyword.$Wc."&limit:".$Limit."&sort:".$Sort."<br>";
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        #curl_setopt($ch, CURLOPT_USERPWD, 'dimneg:dim1978');
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

        //echo $Db; //ok

        //echo $prefix; // ok



        $json=json_decode($response,true);
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
        $Domain="http://83.212.86.162/";
        }
        else
        if (strpos($Actual_link,'83.212.86.164:81') !== false){
        $Domain="http://83.212.86.164:81/";
        }
        else
        $Domain="http://linkedeconomy.org/"; 

        if(isset ($json['rows'])) 
        foreach($json['rows'] as $r)
        {  
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
        case "elod_new_york_buyers":
                $prefix=$Domain.$Lang."newyork/" ;
                        break;  
        case "elod_new_york_sellers":
                $prefix=$Domain.$Lang."newyork/" ;
                        break;
        case "elod_new_york_state_buyers":
                $prefix=$Domain.$Lang."newyorkstate/" ;
                        break;  
        case "elod_new_york_state_sellers":
                $prefix=$Domain.$Lang."newyorkstate/" ;
                        break;
        case "elod_london_city_buyers":
                $prefix=$Domain.$Lang."london/" ;
                        break;  
        case "elod_london_city_sellers":
                $prefix=$Domain.$Lang."london/" ;
                        break; 
        case "elod_europa_fts_buyers":
                $prefix=$Domain.$Lang."eu/" ;
                        break;  
        case "elod_europa_fts_sellers":
                $prefix=$Domain.$Lang."eu/" ;
                        break;
        case "elod_espa_beneficiaries":
                $prefix=$Domain.$Lang."" ;
                        break;
        case "elod_eprices_shops":
                $prefix=$Domain.$Lang."page/" ;
                        break;  
        case "elod_eprices_products":
                $prefix=$Domain.$Lang."page/" ;
                        break;
        case "elod_kath_products":
                $prefix=$Domain.$Lang."" ;
                        break; 
        case "elod_cpv":
                $prefix=$Domain.$Lang."page/" ;
                        break; 	
        case "elod_fuel_prices_products":
                $prefix=$Domain.$Lang."page/" ;
                        break;
        case "elod_fuel_prices_shops":
                $prefix=$Domain.$Lang."page/" ;
                        break;			
        }
        global $Boost;
        $Boost=10;
        switch ($Wc) { //boost step 1
        case "";
                {	

                $r['score'] *=$Boost;
         //$r['score'] *=1;

                break; 

                }
        case "*";
                {

                $r['score'] *=1;

                break; 

                }
        case "~0.75";
            {

                $r['score'] *=1;

                break; 
                }
        }
        //echo $Boost;

        if(isset ($json['rows'])) 
         $newdata =  array (
             // 'name' => $r['fields']['term'][1],
                  'name' => (isset($r['fields']['term'][1])) ? $r['fields']['term'][1] : null ,
                 /* 'smallimage' => (isset($product_option_value_description_query->row['smallimage'])) ?
                $product_option_value_description_query->row['smallimage'] : null, */

              'vat' => $r['fields']['term'][0],
              'link' => $prefix.$r['id'],
                  'address'=>(isset($r['fields']['address']) ) ? $r['fields']['address'] : null ,
                  'pc'=>(isset($r['fields']['pc']) ) ? $r['fields']['pc'] : null ,   
                  'city'=>(isset($r['fields']['city']) ) ? $r['fields']['city'] : null ,
                  'locality'=>(isset($r['fields']['locality']) ) ? $r['fields']['locality'] : null ,
                  'countryName'=>(isset($r['fields']['countryName']) ) ? $r['fields']['countryName'] : null ,
                  'score' =>  $r['score'],
                  'id' => $r['id'],
              'lastUpdate'=> $r['fields']['lastUpdate'],
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

                  // for last item

                   //diaygeia
                  'award0_2'=>' ',	
                  'award1_2'=>' ',
              'award2_2'=> ' ',
                  'awardCnt0_2'=>' ',
                  'awardCnt1_2'=>' ',
                  'awardCnt2_2'=>' ',		  
                  'spend0_2'=>' ',
                  'spend1_2'=>' ',	 
                  'spend2_2'=>' ',	
                  'spendCnt0_2'=>' ',
                  'spendCnt1_2'=>' ',
                  'spendCnt2_2'=>' ',

                  //khmdhs
                  'contractAmountPrev_2'=> ' ',
              'contractAmountCur_2'=>' ', 
                  'paymentAmountPrev_2'=>' ',
              'paymentAmountCur_2'=>' ',	  
              'contractItemsNo_2'=>' ',
              'paymentItemsNo_2'=>' ',   

                  //bοth
                  'lastUpdate_2'=>' ',
              'dk_flag'=>' ',

               //espa  	
                  'SubsContractsAmount'=> (isset($r['fields']['SubsContractsAmount']) ) ? $r['fields']['SubsContractsAmount'] : null ,
                  'SubsPaymentsAmount'=>(isset($r['fields']['SubsPaymentsAmount']) ) ? $r['fields']['SubsPaymentsAmount'] : null ,	
                  'SubsContractsCounter'=>(isset($r['fields']['SubsContractsCounter']) ) ? $r['fields']['SubsContractsCounter'] : null ,
                  'SubsPaymentsCounter'=> (isset($r['fields']['SubsPaymentsCounter']) ) ? $r['fields']['SubsPaymentsCounter'] : null,  
                  'pageKind'=> (isset($r['fields']['pageKind']) ) ? $r['fields']['pageKind'] : null,  
                   //espa extra
                     //espa-khmdhs
                                'linkEKS'=>' ',
                                'contractAmountPrevEKS'=>' ',
                                'contractAmountCurEKS'=>' ',
                            'paymentAmountPrevEKS'=>' ',
                            'paymentAmountCurEKS'=>' ',
                                'contractItemsNoEKS'=>' ',
                                'paymentItemsNoEKS'=>' ',
                                'lastUpdateEKS'=>' ',	

                                'linkEKB'=>' ',
                                'contractAmountPrevEKB'=>' ',
                                'contractAmountCurEKB'=>' ',
                            'paymentAmountPrevEKB'=>' ',
                            'paymentAmountCurEKB'=>' ',
                                'contractItemsNoEKB'=>' ',
                                'paymentItemsNoEKB'=>' ',
                                'lastUpdateEKB'=>' ',	

                        //espa-diaugeia	
                           'linkEDS'=>' ',		  		
                           'award0EDS'=>' ',
                       'award1EDS'=> ' ',
                   'award2EDS'=>' ' ,
                       'awardCnt0EDS'=>' ',
                       'awardCnt1EDS'=>' ' ,
                       'awardCnt2EDS'=>' ' ,	
                       'spend0EDS'=>' ' ,
                           'spend1EDS'=>' ' ,
                       'spend2EDS'=>' ' ,
                       'spendCnt0EDS'=>' '  ,
                       'spendCnt1EDS'=>' ',
                       'spendCnt2EDS'=>' ' ,
                       'lastUpdateEDS'=>' ',

                       'linkEDB'=>' ',
                           'award0EDB'=>' ',
                       'award1EDB'=> ' ',
                   'award2EDB'=>' ' ,
                       'awardCnt0EDB'=>' ',
                       'awardCnt1EDB'=>' ' ,
                       'awardCnt2EDB'=>' ' ,	
                       'spend0EDB'=>' ' ,
                           'spend1EDB'=>' ' ,
                       'spend2EDB'=>' ' ,
                       'spendCnt0EDB'=>' '  ,
                       'spendCnt1EDB'=>' ',
                       'spendCnt2EDB'=>' ' ,
                       'lastUpdateEDB'=>' ',

               //diaugeia-hybrids sellers  
                  'awardSel0'=> (isset($r['fields']['awardAmountSel0']) ) ? $r['fields']['awardAmountSel0'] : null ,
                  'awardSel1'=> (isset($r['fields']['awardAmountSel1']) ) ? $r['fields']['awardAmountSel1'] : null ,
              'awardSel2'=> (isset($r['fields']['awardAmountSel2']) ) ? $r['fields']['awardAmountSel2'] : null ,
                  'awardCntSel0'=> (isset($r['fields']['awardCounterSel0']) ) ? $r['fields']['awardCounterSel0'] : null ,
                  'awardCntSel1'=> (isset($r['fields']['awardCounterSel1']) ) ? $r['fields']['awardCounterSel1'] : null ,
                  'awardCntSel2'=> (isset($r['fields']['awardCounterSel2']) ) ? $r['fields']['awardCounterSel2'] : null ,	  
                  'spendSel0'=> (isset($r['fields']['spendAmountSel0']) ) ? $r['fields']['spendAmountSel0'] : null ,	
              'spendSel1'=> (isset($r['fields']['spendAmountSel1']) ) ? $r['fields']['spendAmountSel1'] : null ,	
                  'spendSel2'=> (isset($r['fields']['spendAmountSel2']) ) ? $r['fields']['spendAmountSel2'] : null ,	
                  'spendCntSel0'=> (isset($r['fields']['spendCounterSel0']) ) ? $r['fields']['spendCounterSel0'] : null ,	
                  'spendCntSel1'=> (isset($r['fields']['spendCounterSel1']) ) ? $r['fields']['spendCounterSel1'] : null ,	
                  'spendCntSel2'=> (isset($r['fields']['spendCounterSel2']) ) ? $r['fields']['spendCounterSel2'] : null ,	

                  //diaugeia-hybrids ->khmdhs
                  'linkHKS'=>' ',
                  'linkHKB'=>' ',
                  'contractAmountPrevHKS'=> ' ' ,
                  'contractAmountPrevHKB'=> ' ' ,
                  'contractAmountCurHKS'=> ' ' ,
                  'contractAmountCurHKS'=> ' ' ,	  
                  'paymentAmountPrevHKS'=> ' ' ,
                  'paymentAmountPrevHKB'=> ' ' ,
              'paymentAmountCurHKS'=> ' ' ,
                  'paymentAmountCurHKB'=> ' ' ,
                  'contractItemsNoHKS'=> ' ' ,
                  'contractItemsNoHKB'=> ' ' ,
                  'paymentItemsNoHKS'=> ' ' ,
                  'paymentItemsNoHKB'=> ' ',
                  'lastUpdateHKS'=> ' ',	  
                  'lastUpdateHKB'=> ' ', 

                  'psName' => (isset($r['fields']['term'][0])) ? $r['fields']['term'][0] : null ,     //product,shop name
                  'minPrice'=>(isset($r['fields']['minPrice']) ) ? $r['fields']['minPrice'] : null , 
                  'maxPrice'=>(isset($r['fields']['maxPrice']) ) ? $r['fields']['maxPrice'] : null ,    
                  //shops     
                  'countOfProducts'=>(isset($r['fields']['countOfProducts']) ) ? $r['fields']['countOfProducts'] : null ,
                  'countOfCategories'=>(isset($r['fields']['countOfCategories']) ) ? $r['fields']['countOfCategories'] : null ,             
              'unitOfMeasurement'=>(isset($r['fields']['unitOfMeasurement']) ) ? $r['fields']['unitOfMeasurement'] : null ,  
                  'unitOfMeasurementMin'=>(isset($r['fields']['unitOfMeasurementMin']) ) ? $r['fields']['unitOfMeasurementMin'] : null , 
                  'unitOfMeasurementMax'=>(isset($r['fields']['unitOfMeasurementMax']) ) ? $r['fields']['unitOfMeasurementMax'] : null , 
              'minProdName'=>(isset($r['fields']['minProdName']) ) ? $r['fields']['minProdName'] : null ,  
              'maxProdName'=>(isset($r['fields']['maxProdName']) ) ? $r['fields']['maxProdName'] : null ,              
               //products	     
                  'average'=>(isset($r['fields']['average']) ) ? $r['fields']['average'] : null ,
                  'averagePreviousYear'=>(isset($r['fields']['averagePreviousYear']) ) ? $r['fields']['averagePreviousYear'] : null ,
                  'variationPrice'=>(isset($r['fields']['variationPrice']) ) ? $r['fields']['variationPrice'] : null, 
                  'locMin'=>(isset($r['fields']['locMin']) ) ? $r['fields']['locMin'] : null, 
                  'locMax'=>(isset($r['fields']['locMax']) ) ? $r['fields']['locMax'] : null,
                  //kath only
                  'dominantPriceDetails'=>(isset($r['fields']['dominantPriceDetails']) ) ? $r['fields']['dominantPriceDetails'] : null ,	
                  'weekDominantPriceDetails'=>(isset($r['fields']['weekDominantPriceDetails']) ) ? $r['fields']['weekDominantPriceDetails'] : null ,		
                  'yearDominantPriceDetails'=>(isset($r['fields']['yearDominantPriceDetails']) ) ? $r['fields']['yearDominantPriceDetails'] : null ,		
              'quantityDetails'=>(isset($r['fields']['quantityDetails']) ) ? $r['fields']['quantityDetails'] : null , 

                   //fuelshops
                  'brand'=>(isset($r['fields']['brand']) ) ? $r['fields']['brand'] : null,  

             //cpv
                 'cpvLabel'=> (isset($r['fields']['label']) ) ? $r['fields']['label'] : null, 
                 'cpvSumofAmounts'=> (isset($r['fields']['cpvSumofAmounts']) ) ? $r['fields']['cpvSumofAmounts'] : null, 

              //relativity for adding score
             'relative1'=>0,	
             'relative2'=>0,
             'relative3'=>0,	
             'relative4'=>0		 
            );	


            $arrayElements=count($Results);
                //echo $arrayElements;
                if  ($arrayElements < 2000)
                $Results[]=$newdata; 
        }


         if (!empty($newdata)) 
                $AlreadyFound = 1 ;  
         else 
                $AlreadyFound = 0;

    } 
}
