<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of results
 *
 * @author dimitris negkas
 */
class results {
    function showResults_temp(){
        global $Actual_link;
        global $Lang;
        global $prefix;
        global $Results;
        $source = ' ';
        $Actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $double=[[]];
        if (strpos($Actual_link,'/en/') !== false) {
            $Lang = 'en/';
        }
        else {
             if (strpos($Actual_link,'/el/') !== false) {
                $Lang = 'el/';
             }
             else {
                 $Lang = '';
             }
        }
        
        $uniqueResults = $this->unique_multidim_array($Results,'link');
        foreach ($uniqueResults as $key => $row) {
            $id[$key]  = $row['id']; 	  
        }
        array_multisort($id, SORT_ASC, $uniqueResults );
        $uniqueResults  = array_reverse($uniqueResults );
        $last_item = NULL;
        $last_item_2 = NULL;
        $last_item_3 = NULL;
        $last_item_4 = NULL;
        $numItems = count($uniqueResults);
        $c = 0;
        foreach ($uniqueResults as $key => &$row) { //diaygeia + khmdhs (2 records) become  diaygeiakhmdhs (1 record) for buyer and one for seller if exist
            if   (strpos($row['link'],'diaugeia/organization-hybrid') !== false){
                $row['link'] = str_replace('diaugeia/organization-hybrid','zdiaugeia/diaugeia-hybrids',$row['link']);
            }
            if   (strpos($row['link'],'organization-beneficiary') !== false){
                $row['link']=str_replace('organization-beneficiary','zorganization-beneficiary',$row['link']);
            }
            if ($last_item['id'] === $row['id'])   {
                $double[] = $last_item; //copy doubles to other table
                if (strpos($row['link'],'/diaugeia/') !== false ) { //DIAUGEIA
                    $row['dk_flag']='d';
	            $row['link'] =  str_replace('diaugeia','diaugeiakhmdhs', $row['link'] );			
	            $row['lastUpdate_2'] = $last_item['lastUpdate'];			
		    $row['contractAmountPrev_2'] = $last_item['contractAmountPrev'];
		    $row['contractAmountCur_2'] = $last_item['contractAmountCur'];
		    $row['paymentAmountPrev_2'] = $last_item['paymentAmountPrev'];
		    $row['paymentAmountCur_2'] = $last_item['paymentAmountCur'];
		    $row['contractItemsNo_2'] = $last_item['contractItemsNo'];
		    $row['paymentItemsNo_2'] = $last_item['paymentItemsNo']; 
			
                }
                else {
                     if (strpos($row['link'],'/khmdhs/') !== false ) 	{ //KHMDHS
                        $row['dk_flag']='k';
			$row['link'] =  str_replace('khmdhs','diaugeiakhmdhs', $row['link'] );
			$row['address'] =  $last_item['address'];			
			$row['pc'] =  $last_item['pc'];
			$row['city'] =  $last_item['city'];
			$row['lastUpdate_2']=$last_item['lastUpdate'];			
			$row['award0_2']=$last_item['award0'];
			$row['award1_2']=$last_item['award1'];	
			$row['award2_2']=$last_item['award2'];	
			$row['awardCnt0_2']=$last_item['awardCnt0'];	
			$row['awardCnt1_2']=$last_item['awardCnt1'];	
			$row['awardCnt2_2']=$last_item['awardCnt2'];			  
			$row['spend0_2']=$last_item['spend0'];
			$row['spend1_2']=$last_item['spend1'];
			$row['spend2_2']=$last_item['spend2'];
			$row['spendCnt0_2']=$last_item['spendCnt0'];
			$row['spendCnt1_2']=$last_item['spendCnt1'];
			$row['spendCnt2_2']=$last_item['spendCnt2'];
                    }
                }
                 $row['relative1'] = $last_item['score']; //boost step 3
            }
            if(++$c !== $numItems) {
                $last_item = $row;
	        $last_item_2 = $last_item;
            }
        }
        $c = 0;
        $toMerge = 0;
        foreach ($uniqueResults as $key => &$row){
            $sort['id'][$key] = substr($row['id'],strpos($row['id'], "?=") );
            $sort['link'][$key] = $row['link'];
        }
        array_multisort($sort['id'], SORT_ASC, $sort['link'], SORT_ASC,$uniqueResults );
        foreach ($uniqueResults as $key => &$row){
            if (strpos($row['link'],'zdiaugeia') !== false){
                if ((substr($row['id'],strpos($row['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") ))){
                    if ($row['relative1'] == 0) {
                        $row['relative1'] = $last_item['score']; //boost rel1
                    }
                    if ((strpos($last_item['link'],'/diaugeia/') !== false ) || (strpos($last_item['link'],'/diaugeiakhmdhs/') !== false ) ) {
                        $double[] = $last_item;
                    }
                    if (strpos($last_item['link'],'/khmdhs/') !== false ) {
                        $double[]=$last_item;
                        if (strpos($last_item['link'],'seller')!== false){
                            $row['linkHKS']=$last_item['link'];		
                            $row['contractAmountPrevHKS']=$last_item['contractAmountPrev']; 
                            $row['contractAmountCurHKS']=$last_item['contractAmountCur'];
                            $row['paymentAmountPrevHKS']=$last_item['paymentAmountPrev'];
                            $row['paymentAmountCurHKS']=$last_item['paymentAmountCur'];
                            $row['contractItemsNoHKS']=$last_item['contractItemsNo'];
                            $row['paymentItemsNoHKS']=$last_item['paymentItemsNo'];
                            $row['lastUpdateHKS']=$last_item['lastUpdate'];	 
                        }
                        else {
                            $row['linkHKB']=$last_item['link'];	
                            $row['contractAmountPrevHKB']=$last_item['contractAmountPrev']; 
                            $row['contractAmountCurHKB']=$last_item['contractAmountCur'];
                            $row['paymentAmountPrevHKB']=$last_item['paymentAmountPrev'];
                            $row['paymentAmountCurHKB']=$last_item['paymentAmountCur'];
                            $row['contractItemsNoHKB']=$last_item['contractItemsNo'];
                            $row['paymentItemsNoHKB']=$last_item['paymentItemsNo'];	 
                            $row['lastUpdateHKB']=$last_item['lastUpdate'];	 
                        }
                    }
                    if ((substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") ))){
                         $row['relative2']=$last_item_2['score']; //boost rel2
                         if ((strpos($last_item_2['link'],'/diaugeia/') !== false ) || (strpos($last_item_2['link'],'/diaugeiakhmdhs/') !== false ) ) {
                             $double[] = $last_item_2;                             
                         }
                         if (strpos($last_item_2['link'],'/khmdhs/') !== false ) {
                             $double[]=$last_item_2;
                             if (strpos($last_item_2['link'],'seller')!== false){
                                 $row['linkHKS']=$last_item_2['link'];			
                                 $row['contractAmountPrevHKS']=$last_item_2['contractAmountPrev']; 
                                 $row['contractAmountCurHKS']=$last_item_2['contractAmountCur'];
                                 $row['paymentAmountPrevHKS']=$last_item_2['paymentAmountPrev'];
                                 $row['paymentAmountCurHKS']=$last_item_2['paymentAmountCur'];
                                 $row['contractItemsNoHKS']=$last_item_2['contractItemsNo'];
                                 $row['paymentItemsNoHKS']=$last_item_2['paymentItemsNo'];
                                 $row['lastUpdateHKS']=$last_item_2['lastUpdate'];	
                             }
                             else {
                                 $row['linkHKB']=$last_item_2['link'];
                                 $row['contractAmountPrevHKB']=$last_item_2['contractAmountPrev']; 
                                 $row['contractAmountCurHKB']=$last_item_2['contractAmountCur'];
                                 $row['paymentAmountPrevHKB']=$last_item_2['paymentAmountPrev'];
                                 $row['paymentAmountCurHKB']=$last_item_2['paymentAmountCur'];
                                 $row['contractItemsNoHKB']=$last_item_2['contractItemsNo'];
                                 $row['paymentItemsNoHKB']=$last_item_2['paymentItemsNo'];	 
                                 $row['lastUpdateHKB']=$last_item_2['lastUpdate'];	
                             }
                         }
                         if ((substr($last_item_3['id'],strpos($last_item_3['id'], "?=") )) == (substr($last_item_2['id'],strpos($last_item_2['id'], "?=") ))){
                             $row['relative3'] = $last_item_3['score']; //boost rel3
                             if ((strpos($last_item_3['link'],'/diaugeia/') !== false ) || (strpos($last_item_3['link'],'/diaugeiakhmdhs/') !== false ) ) {
                                 $double[]=$last_item_3;
                             }
                             if (strpos($last_item_3['link'],'/khmdhs/') !== false ) {
                                 $double[]=$last_item_3;
                                 if (strpos($last_item_3['link'],'seller')!== false){
                                     $row['linkHKS']=$last_item_3['link'];						
				     $row['contractAmountPrevHKS']=$last_item_3['contractAmountPrev']; 
				     $row['contractAmountCurHKS']=$last_item_3['contractAmountCur'];
				     $row['paymentAmountPrevHKS']=$last_item_3['paymentAmountPrev'];
				     $row['paymentAmountCurHKS']=$last_item_3['paymentAmountCur'];
				     $row['contractItemsNoHKS']=$last_item_3['contractItemsNo'];
				     $row['paymentItemsNoHKS']=$last_item_3['paymentItemsNo'];
				     $row['lastUpdateHKS']=$last_item_3['lastUpdate'];	
                                 }
                                 else {
                                     $row['linkHKB']=$last_item_3['link'];
				     $row['contractAmountPrevHKB']=$last_item_3['contractAmountPrev']; 
				     $row['contractAmountCurHKB']=$last_item_3['contractAmountCur'];
				     $row['paymentAmountPrevHKB']=$last_item_3['paymentAmountPrev'];
				     $row['paymentAmountCurHKB']=$last_item_3['paymentAmountCur'];
				     $row['contractItemsNoHKB']=$last_item_3['contractItemsNo'];
				     $row['paymentItemsNoHKB']=$last_item_3['paymentItemsNo'];	 
				     $row['lastUpdateHKB']=$last_item_3['lastUpdate'];	
                                 }
                             }
                             if ((substr($last_item_4['id'],strpos($last_item_4['id'], "?=") )) == (substr($last_item_3['id'],strpos($last_item_3['id'], "?=") ))){
                                 $row['relative4']=$last_item_4['score']; //boost rel4
                                 if ((strpos($last_item_4['link'],'/diaugeia/') !== false ) || (strpos($last_item_4['link'],'/diaugeiakhmdhs/') !== false ) ) {
                                     $double[]=$last_item_4;
                                 }
                                 if (strpos($last_item_4['link'],'/khmdhs/') !== false ) {
                                     $double[]=$last_item_4;
                                     if (strpos($last_item_4['link'],'seller')!== false){
                                         $row['linkHKS']=$last_item_4['link'];						
					 $row['contractAmountPrevHKS']=$last_item_4['contractAmountPrev']; 
					 $row['contractAmountCurHKS']=$last_item_4['contractAmountCur'];
					 $row['paymentAmountPrevHKS']=$last_item_4['paymentAmountPrev'];
					 $row['paymentAmountCurHKS']=$last_item_4['paymentAmountCur'];
					 $row['contractItemsNoHKS']=$last_item_4['contractItemsNo'];
					 $row['paymentItemsNoHKS']=$last_item_4['paymentItemsNo'];
					 $row['lastUpdateHKS']=$last_item_4['lastUpdate'];	
                                     }
                                     else {
                                        $row['linkHKB']=$last_item_4['link'];
					$row['contractAmountPrevHKB']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurHKB']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevHKB']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurHKB']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoHKB']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoHKB']=$last_item_4['paymentItemsNo'];	 
					$row['lastUpdateHKB']=$last_item_4['lastUpdate'];	
                                     }
                                 }
                             }
                         }
                    }
                }
            }
             if(++$c !== $numItems) {
                 $last_item_4=$last_item_3;
                 $last_item_3=$last_item_2;
                 $last_item_2=$last_item;
	         $last_item = $row;
             }
        }
        foreach ($uniqueResults as $key => &$row){
            $sort['id'][$key] = substr($row['id'],strpos($row['id'], "?=") );
            $sort['link'][$key] = $row['link'];
        }
        array_multisort($sort['id'], SORT_ASC, $sort['link'], SORT_ASC,$uniqueResults );
        foreach ($uniqueResults as $key => &$row){
            if    ((strpos($row['link'],'espa') !== false) ||(strpos($row['link'],'beneficiary') !== false)){
                if ((substr($row['id'],strpos($row['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") ))) {
                    $row['relative1']=$last_item['score'];
                    if ((strpos($last_item['link'],'/diaugeia/') !== false ) || (strpos($last_item['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item['link'],'hybrid') !== false )){
                        $double[]=$last_item; //for hide
                        if (strpos($last_item['link'],'seller')!== false){
                            $row['linkEDS']=$last_item['link'];	
                            $row['award0EDS']=$last_item['award0']; 
                            $row['award1EDS']=$last_item['award1'];
	                    $row['award2EDS']=$last_item['award2'];
	                    $row['awardCnt0EDS']=$last_item['awardCnt0'];
	                    $row['awardCnt1EDS']=$last_item['awardCnt1'];
                            $row['awardCnt2EDS']=$last_item['awardCnt2'];
                            $row['spend0EDS']=$last_item['spend0'];	
                            $row['spend1EDS']=$last_item['spend1'];
                            $row['spend2EDS']=$last_item['spend2']; 	   
                            $row['spendCnt0EDS']=$last_item['spendCnt0']; 
                            $row['spendCnt1EDS']=$last_item['spendCnt1'];
                            $row['spendCnt2EDS']=$last_item['spendCnt2'];
                            $row['lastUpdateEDS']=$last_item['lastUpdate'];   
                        }
                        else {
                            $row['linkEDB']=$last_item['link'];	
                            $row['award0EDB']=$last_item['award0']; 
	                    $row['award1EDB']=$last_item['award1'];
                            $row['award2EDB']=$last_item['award2'];
                            $row['awardCnt0EDB']=$last_item['awardCnt0'];
                            $row['awardCnt1EDB']=$last_item['awardCnt1'];
                            $row['awardCnt2EDB']=$last_item['awardCnt2'];
                            $row['spend0EDB']=$last_item['spend0'];	
                            $row['spend1EDB']=$last_item['spend1'];
                            $row['spend2EDB']=$last_item['spend2']; 	   
                            $row['spendCnt0EDB']=$last_item['spendCnt0']; 
                            $row['spendCnt1EDB']=$last_item['spendCnt1'];
                            $row['spendCnt2EDB']=$last_item['spendCnt2'];
                            $row['lastUpdateEDB']=$last_item['lastUpdate'];
                        }
                    }
                    if (strpos($last_item['link'],'/khmdhs/') !== false ) {
                        $double[]=$last_item; // for hide
                        if (strpos($last_item['link'],'seller')!== false){
                            $row['linkEKS']=$last_item['link'];		
                            $row['contractAmountPrevEKS']=$last_item['contractAmountPrev']; 
                            $row['contractAmountCurEKS']=$last_item['contractAmountCur'];
                            $row['paymentAmountPrevEKS']=$last_item['paymentAmountPrev'];
                            $row['paymentAmountCurEKS']=$last_item['paymentAmountCur'];
                            $row['contractItemsNoEKS']=$last_item['contractItemsNo'];
                            $row['paymentItemsNoEKS']=$last_item['paymentItemsNo'];
                            $row['lastUpdateEKS']=$last_item['lastUpdate'];	 
                        }
                        else {
                             $row['linkEKB']=$last_item['link'];	
                             $row['contractAmountPrevEKB']=$last_item['contractAmountPrev']; 
                             $row['contractAmountCurEKB']=$last_item['contractAmountCur'];
                             $row['paymentAmountPrevEKB']=$last_item['paymentAmountPrev'];
                             $row['paymentAmountCurEKB']=$last_item['paymentAmountCur'];
                             $row['contractItemsNoEKB']=$last_item['contractItemsNo'];
                             $row['paymentItemsNoEKB']=$last_item['paymentItemsNo'];	 
                             $row['lastUpdateEKB']=$last_item['lastUpdate'];	 
                        }
                    }
                    if ((substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") ))) {
                        $row['relative2']=$last_item_2['score'];
                        if ((strpos($last_item_2['link'],'/diaugeia/') !== false ) || (strpos($last_item_2['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_2['link'],'hybrid') !== false )){
                            $double[]=$last_item_2; //for hide
                            if (strpos($last_item_2['link'],'seller')!== false){
                                $row['linkEDS']=$last_item_2['link'];	
                                $row['award0EDS']=$last_item_2['award0']; 
                                $row['award1EDS']=$last_item_2['award1'];
                                $row['award2EDS']=$last_item_2['award2'];
                                $row['awardCnt0EDS']=$last_item_2['awardCnt0'];
                                $row['awardCnt1EDS']=$last_item_2['awardCnt1'];
                                $row['awardCnt2EDS']=$last_item_2['awardCnt2'];
                                $row['spend0EDS']=$last_item_2['spend0'];	
                                $row['spend1EDS']=$last_item_2['spend1'];
                                $row['spend2EDS']=$last_item_2['spend2']; 	   
                                $row['spendCnt0EDS']=$last_item_2['spendCnt0']; 
                                $row['spendCnt1EDS']=$last_item_2['spendCnt1'];
                                $row['spendCnt2EDS']=$last_item_2['spendCnt2'];
                                $row['lastUpdateEDS']=$last_item_2['lastUpdate'];   			
	   
                            }
                            else {
                                $row['linkEDB']=$last_item_2['link'];	
                                $row['award0EDB']=$last_item_2['award0']; 
                                $row['award1EDB']=$last_item_2['award1'];
                                $row['award2EDB']=$last_item_2['award2'];
                                $row['awardCnt0EDB']=$last_item_2['awardCnt0'];
                                $row['awardCnt1EDB']=$last_item_2['awardCnt1'];
                                $row['awardCnt2EDB']=$last_item_2['awardCnt2'];
                                $row['spend0EDB']=$last_item_2['spend0'];	
                                $row['spend1EDB']=$last_item_2['spend1'];
                                $row['spend2EDB']=$last_item_2['spend2']; 	   
                                $row['spendCnt0EDB']=$last_item_2['spendCnt0']; 
                                $row['spendCnt1EDB']=$last_item_2['spendCnt1'];
                                $row['spendCnt2EDB']=$last_item_2['spendCnt2'];
                                $row['lastUpdateEDB']=$last_item_2['lastUpdate'];
                            }
                        }
                        if (strpos($last_item_2['link'],'/khmdhs/') !== false ) {
                            $double[]=$last_item_2;
                            if (strpos($last_item_2['link'],'seller')!== false){
                                $row['linkEKS']=$last_item_2['link'];			
                                $row['contractAmountPrevEKS']=$last_item_2['contractAmountPrev']; 
                                $row['contractAmountCurEKS']=$last_item_2['contractAmountCur'];
                                $row['paymentAmountPrevEKS']=$last_item_2['paymentAmountPrev'];
                                $row['paymentAmountCurEKS']=$last_item_2['paymentAmountCur'];
                                $row['contractItemsNoEKS']=$last_item_2['contractItemsNo'];
                                $row['paymentItemsNoEKS']=$last_item_2['paymentItemsNo'];
                                $row['lastUpdateEKS']=$last_item_2['lastUpdate'];
                            }
                            else {
                                $row['linkEKB']=$last_item_2['link'];
                                $row['contractAmountPrevEKB']=$last_item_2['contractAmountPrev']; 
                                $row['contractAmountCurEKB']=$last_item_2['contractAmountCur'];
                                $row['paymentAmountPrevEKB']=$last_item_2['paymentAmountPrev'];
                                $row['paymentAmountCurEKB']=$last_item_2['paymentAmountCur'];
                                $row['contractItemsNoEKB']=$last_item_2['contractItemsNo'];
                                $row['paymentItemsNoEKB']=$last_item_2['paymentItemsNo'];	 
                                $row['lastUpdateEKB']=$last_item_2['lastUpdate'];
                            }
                        }
                        if ((substr($last_item_3['id'],strpos($last_item_3['id'], "?=") )) == (substr($last_item_2['id'],strpos($last_item_2['id'], "?=") ))) {
                            $row['relative3']=$last_item_2['score'];
                            if ((strpos($last_item_3['link'],'/diaugeia/') !== false ) || (strpos($last_item_3['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_3['link'],'hybrid') !== false ) ){
                                $double[]=$last_item_3;
                                if (strpos($last_item_3['link'],'seller')!== false){
                                    $row['linkEDS']=$last_item_3['link'];	
			            $row['award0EDS']=$last_item_3['award0']; 
				    $row['award1EDS']=$last_item_3['award1'];
				    $row['award2EDS']=$last_item_3['award2'];
				    $row['awardCnt0EDS']=$last_item_3['awardCnt0'];
				    $row['awardCnt1EDS']=$last_item_3['awardCnt1'];
				    $row['awardCnt2EDS']=$last_item_3['awardCnt2'];
				    $row['spend0EDS']=$last_item_3['spend0'];	
				    $row['spend1EDS']=$last_item_3['spend1'];
				    $row['spend2EDS']=$last_item_3['spend2']; 	   
				    $row['spendCnt0EDS']=$last_item_3['spendCnt0']; 
				    $row['spendCnt1EDS']=$last_item_3['spendCnt1'];
				    $row['spendCnt2EDS']=$last_item_3['spendCnt2'];
				    $row['lastUpdateEDS']=$last_item_3['lastUpdate'];  			
	   
                                }
                                else {
                                    $row['linkEDB']=$last_item_3['link'];	
				    $row['award0EDB']=$last_item_3['award0']; 
                                    $row['award1EDB']=$last_item_3['award1'];
                                    $row['award2EDB']=$last_item_3['award2'];
                                    $row['awardCnt0EDB']=$last_item_3['awardCnt0'];
                                    $row['awardCnt1EDB']=$last_item_3['awardCnt1'];
                                    $row['awardCnt2EDB']=$last_item_3['awardCnt2'];
                                    $row['spend0EDB']=$last_item_3['spend0'];	
                                    $row['spend1EDB']=$last_item_3['spend1'];
                                    $row['spend2EDB']=$last_item_3['spend2']; 	   
                                    $row['spendCnt0EDB']=$last_item_3['spendCnt0']; 
                                    $row['spendCnt1EDB']=$last_item_3['spendCnt1'];
                                    $row['spendCnt2EDB']=$last_item_3['spendCnt2'];
                                    $row['lastUpdateEDB']=$last_item_3['lastUpdate'];
                                }
                            }
                            if (strpos($last_item_3['link'],'/khmdhs/') !== false ) {
                                $double[]=$last_item_3;
                                if (strpos($last_item_3['link'],'seller')!== false){
                                    $row['linkEKS']=$last_item_3['link'];						
				    $row['contractAmountPrevEKS']=$last_item_3['contractAmountPrev']; 
				    $row['contractAmountCurEKS']=$last_item_3['contractAmountCur'];
				    $row['paymentAmountPrevEKS']=$last_item_3['paymentAmountPrev'];
				    $row['paymentAmountCurEKS']=$last_item_3['paymentAmountCur'];
				    $row['contractItemsNoEKS']=$last_item_3['contractItemsNo'];
				    $row['paymentItemsNoEKS']=$last_item_3['paymentItemsNo'];
				    $row['lastUpdateEKS']=$last_item_3['lastUpdate'];	
                                }
                                else {
                                    $row['linkEKB']=$last_item_3['link'];
				    $row['contractAmountPrevEKB']=$last_item_3['contractAmountPrev']; 
				    $row['contractAmountCurEKB']=$last_item_3['contractAmountCur'];
				    $row['paymentAmountPrevEKB']=$last_item_3['paymentAmountPrev'];
				    $row['paymentAmountCurEKB']=$last_item_3['paymentAmountCur'];
				    $row['contractItemsNoEKB']=$last_item_3['contractItemsNo'];
				    $row['paymentItemsNoEKB']=$last_item_3['paymentItemsNo'];	 
				    $row['lastUpdateEKB']=$last_item_3['lastUpdate'];	
                                }
                            }
                            if ((substr($last_item_4['id'],strpos($last_item_4['id'], "?=") )) == (substr($last_item_3['id'],strpos($last_item_3['id'], "?=") ))){
                                $row['relative4']=$last_item_3['score'];
                                if ((strpos($last_item_4['link'],'/diaugeia/') !== false ) || (strpos($last_item_4['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_4['link'],'hybrid') !== false ) ){	
                                    $double[]=$last_item_4;
                                    if (strpos($last_item_4['link'],'seller')!== false){
                                        $row['linkEDS']=$last_item_4['link'];	
					$row['award0EDS']=$last_item_4['award0']; 
					$row['award1EDS']=$last_item_4['award1'];
					$row['award2EDS']=$last_item_4['award2'];
					$row['awardCnt0EDS']=$last_item_4['awardCnt0'];
					$row['awardCnt1EDS']=$last_item_4['awardCnt1'];
					$row['awardCnt2EDS']=$last_item_4['awardCnt2'];
					$row['spend0EDS']=$last_item_4['spend0'];	
					$row['spend1EDS']=$last_item_4['spend1'];
					$row['spend2EDS']=$last_item_4['spend2']; 	   
					$row['spendCnt0EDS']=$last_item_4['spendCnt0']; 
					$row['spendCnt1EDS']=$last_item_4['spendCnt1'];
					$row['spendCnt2EDS']=$last_item_4['spendCnt2'];
					$row['lastUpdateEDS']=$last_item_4['lastUpdate'];  
                                    }
                                    else {
                                        $row['linkEDB']=$last_item_4['link'];	
				        $row['award0EDB']=$last_item_4['award0']; 
                                        $row['award1EDB']=$last_item_4['award1'];
                                        $row['award2EDB']=$last_item_4['award2'];
                                        $row['awardCnt0EDB']=$last_item_4['awardCnt0'];
                                        $row['awardCnt1EDB']=$last_item_4['awardCnt1'];
                                        $row['awardCnt2EDB']=$last_item_4['awardCnt2'];
                                        $row['spend0EDB']=$last_item_4['spend0'];	
                                        $row['spend1EDB']=$last_item_4['spend1'];
                                        $row['spend2EDB']=$last_item_4['spend2']; 	   
                                        $row['spendCnt0EDB']=$last_item_4['spendCnt0']; 
                                        $row['spendCnt1EDB']=$last_item_4['spendCnt1'];
                                        $row['spendCnt2EDB']=$last_item_4['spendCnt2'];
                                        $row['lastUpdateEDB']=$last_item_4['lastUpdate'];	
                                    }
                                }
                                if (strpos($last_item_4['link'],'/khmdhs/') !== false ) {
                                    $double[]=$last_item_4;
                                    if (strpos($last_item_4['link'],'seller')!== false){
                                        $row['linkEKS']=$last_item_4['link'];						
					$row['contractAmountPrevEKS']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurEKS']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevEKS']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurEKS']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoEKS']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoEKS']=$last_item_4['paymentItemsNo'];
					$row['lastUpdateEKS']=$last_item_4['lastUpdate'];	
                                    }
                                    else {
                                        $row['linkEKB']=$last_item_4['link'];
					$row['contractAmountPrevEKB']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurEKB']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevEKB']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurEKB']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoEKB']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoEKB']=$last_item_4['paymentItemsNo'];	 
					$row['lastUpdateEKB']=$last_item_4['lastUpdate'];	
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if(++$c !== $numItems) {
                $last_item_4=$last_item_3;
                $last_item_3=$last_item_2;
                $last_item_2=$last_item;
                $last_item = $row;
            }
           } //check
            $i = 0;
            $sumResults=count($uniqueResults);
            $sumSpend=0;
            $sumAward=0;
            $sumContracts=0;
            $sumPayments=0;
            $counterContracts=0;
            $sumAwardSel=0;
            $sumSpendSel=0;
            
            echo "<table id='searchResults' class='display'  ><thead><tr><th></th></th></th> </tr></thead>";  
            echo "<tbody>";
            while ($i<$sumResults) { 
                if  (!is_numeric($uniqueResults[$i]['vat'])) { //boost step 2
                    $uniqueResults[$i]['score'] = bcmul(0.75,$uniqueResults[$i]['score'] ,4) ;
                }
                if  ( (isset($uniqueResults[$i]['link'])) &&  (strpos($uniqueResults[$i]['link'],'person') == false) && ($this->hideDuplicate($double,$uniqueResults[$i]['link'])!= 1) ) {
                    $link=($uniqueResults[$i]['link']);
                    if   (strpos($link,'zdiaugeia/diaugeia-hybrids') !== false) {
                        $link=str_replace('zdiaugeia/','diaugeia/',$link);
                    }
                    if (($uniqueResults[$i]['pageKind']) =='sellerBoth') {
                        $link= str_replace('zorganization-beneficiary','espa-both-organization-seller',$link); //diaugeiakhmdhs+diaugeiakhmdhs+espa
                    }
                    else {
                        if (($uniqueResults[$i]['pageKind']) =='buyerBoth') {
                            $link= str_replace('zorganization-beneficiary','espa-both-organization-buyer',$link); //diaugeiakhmdhs+diaugeiakhmdhs+espa
                        }
                        else {
                            if (($uniqueResults[$i]['pageKind']) =='sellerDiavgeia') {
                                $link= str_replace('zorganization-beneficiary','espa-diavgeia-organization-seller',$link); //diaugeia+espa
                            }
                            else {
                                if (($uniqueResults[$i]['pageKind']) =='buyerDiavgeia'){
                                    $link= str_replace('zorganization-beneficiary','espa-diavgeia-organization-buyer',$link); //diaugeia+espa
                                }
                                else {
                                    if (($uniqueResults[$i]['pageKind']) =='sellerKhmdhs') {
                                        $link= str_replace('zorganization-beneficiary','espa-khmdhs-organization-seller',$link); //khmdhs+espa
                                    }
                                    else {
                                        if (($uniqueResults[$i]['pageKind']) =='buyerKhmdhs') {
                                            $link= str_replace('zorganization-beneficiary','espa-khmdhs-organization-buyer',$link); //khmdhs+espa
                                        }
                                        else {
                                            if  ((($uniqueResults[$i]['pageKind']) =='') || (($uniqueResults[$i]['pageKind']) =='general')) {
                                                $link= str_replace('zorganization-beneficiary','organization-beneficiary',$link);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $nameLink=$link;
                    $name=$uniqueResults[$i]['name'];
                    $psName=$uniqueResults[$i]['psName'];
                    $property=' ';
                    if    ((strpos($link,'seller') !== false) && (strpos($link,'espa') == false)) {
                        $property='ΑΝΑΔΟΧΟΣ';
                    }
                    else {
                        if    ((strpos($link,'buyer') !== false)&& (strpos($link,'espa') == false)){
                            $property='ΦΟΡΕΑΣ';
                        }
                        else {
                            if    (strpos($link,'hybrid') !== false){
                                $property='ΥΒΡΙΔΙΚΟΣ';
                            }
                            else {
                                if    ((strpos($link,'espa') !== false) ||(strpos($link,'beneficiary') !== false)){
                                    $property='ΔΙΚΑΙΟΥΧΟΣ';
                                }
                                else {
                                    if (strpos($link,'cpv') !== false) {
                                        if ($uniqueResults[$i]['cpvLabel']=='sub') {
                                             $property='Υποκατηγορία';
                                        }
                                        else {
                                            $property='Κύρια Κατηγορία';
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo "<tr>";
                    if  (strpos($link,'diaugeia/org') !== false)   {
                        echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
                        //echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
                        //echo '<B>'.$name.'</B><br>';
                        echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
                        //echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
                        echo '<I>';
                        echo $this->hide_not_avail($uniqueResults[$i]['address']);
                        echo ' ';
                        echo $this->hide_not_avail($uniqueResults[$i]['pc']);
                        echo ' ';
                        echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
                        echo ' ';
                        echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
                        echo '</I>';
                        //echo  '<B>'.(getSource($link,'d')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
                        //echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
                        //echo '<B>';
                        echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
                        echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
                        //echo '</B>';
                        echo  'Οριστικοποίηση Πληρωμών: ';
                                $sumSpend=  $this->fromTextToNumber($uniqueResults[$i]['spend0']) + $this->fromTextToNumber($uniqueResults[$i]['spend1']) + $this->fromTextToNumber($uniqueResults[$i]['spend2'])  ;
                        echo '<B> '.$this->fromNumberToText($sumSpend,'€').'</B>';
                        echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0']+$uniqueResults[$i]['spendCnt1']+$uniqueResults[$i]['spendCnt2']),0).'</B>) '; 
                        echo  'Κατακυρώσεις: ';
                                $sumAward=$this->fromTextToNumber($uniqueResults[$i]['award0']) + $this->fromTextToNumber($uniqueResults[$i]['award1']) + $this->fromTextToNumber($uniqueResults[$i]['award2'])  ;
                        echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
                        echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>) '; 
                        echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
                        echo "</td>";
                    }
                    else if ((strpos($link,'espa') !== false) ||(strpos($link,'beneficiary') !== false) )    {
                        echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	
                        //echo '<B>'.$name.'</B><br>';
                        echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";
                        /*echo 'r1='.$uniqueResults[$i]['relative1'].'<br>';
                        echo 'r2='.$uniqueResults[$i]['relative2'].'<br>';
                        echo 'r3='.$uniqueResults[$i]['relative3'].'<br>';
                        echo 'r4='.$uniqueResults[$i]['relative4'].'<br>';*/
                        echo '<I>';
                        echo $this->hide_not_avail($uniqueResults[$i]['address']);
                        echo ' ';
                        echo $this->hide_not_avail($uniqueResults[$i]['pc']);
                        echo ' ';
                        echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
                        echo ' ';
                        echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
                        echo '</I>';
                        
                        if (($uniqueResults[$i]['pageKind']) =='sellerBoth'){ //eg 999243471 099360290
                            echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
                            $link4=$uniqueResults[$i]['linkEDB'];   
                            if ((isset($link4)) && ($link4 !== ' ')) {
                                //echo $link4."</br>";
                                //echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
                                //echo "<a href='".$link4."'target='_blank' fontcolor='#FFA500' size='1' > <B>Φορέας </B></a> ";
                                echo "<a href='".$link4."'target='_blank' style='font-size: 10px; color: #FFA500;'  <B>ΦΟΡΕΑΣ</B> </a> ";
                                //echo ' <font color="#FFA500" size="1">Ανάδοχος</font> '; 
                                echo  'Οριστικοποίηση Πληρωμών: ';               
                                        $sumSpend=$this->fromTextToNumber($uniqueResults[$i]['spend0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDB'])  ;
                                echo '<B> '.fromNumberToText($sumSpend,'€').'</B>';
                                echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDB']+$uniqueResults[$i]['spendCnt1EDB']+$uniqueResults[$i]['spendCnt2EDB']),0).'</B>) '; 
                                echo  'Κατακυρώσεις: ';
                                        $sumAward=$this->fromTextToNumber($uniqueResults[$i]['award0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDB'])  ;
                                echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
                                echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDB']+$uniqueResults[$i]['awardCnt1EDB']+$uniqueResults[$i]['awardCnt2EDB']),0).'</B>) '; 
                                echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDB'].']</br>';
                            }
                        }
                    }
                    
                }
        
        }
    }
    function showResults(){


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

global $prefix;

global $Results;
$source=' ';
$double=array();


//make array unique


$uniqueResults = $this->unique_multidim_array($Results,'link');

////////check for diaugeiaKhmdhs////////
////////////////////////////////////////
//////////////////////////////////////////
foreach ($uniqueResults as $key => $row) {
  $id[$key]  = $row['id']; 	  
}
//print_r($id);
array_multisort($id, SORT_ASC, $uniqueResults );
$uniqueResults  = array_reverse($uniqueResults );
//print_r ($uniqueResults);
$last_item = NULL;
$last_item_2 = NULL;
$last_item_3 = NULL;
$last_item_4 = NULL;
$numItems = count($uniqueResults);
$c = 0;
foreach ($uniqueResults as $key => &$row) { //diaygeia + khmdhs (2 records) become  diaygeiakhmdhs (1 record) for buyer and one for seller if exist
//echo $c.'for<br>';
if   (strpos($row['link'],'diaugeia/organization-hybrid') !== false)
$row['link']=str_replace('diaugeia/organization-hybrid','zdiaugeia/diaugeia-hybrids',$row['link']);
if   (strpos($row['link'],'organization-beneficiary') !== false)
$row['link']=str_replace('organization-beneficiary','zorganization-beneficiary',$row['link']);
//echo 'r='.$row['link'].'<br>';
//echo 'l2='.$last_item_2['link'].'<br>';
//echo substr($row['link'],strpos($row['link'], "?=") ); 
		if ($last_item['id'] === $row['id'])   {
		
		
		
					
		$double[]=$last_item; //copy doubles to other table
		   
		 
		  
		   
	
		if (strpos($row['link'],'/diaugeia/') !== false ) { //DIAUGEIA
			$row['dk_flag']='d';
			$row['link'] =  str_replace('diaugeia','diaugeiakhmdhs', $row['link'] );	
			
			$row['lastUpdate_2']=$last_item['lastUpdate'];
			
			$row['contractAmountPrev_2']=$last_item['contractAmountPrev'];
			$row['contractAmountCur_2']=$last_item['contractAmountCur'];
			$row['paymentAmountPrev_2']=$last_item['paymentAmountPrev'];
			$row['paymentAmountCur_2']=$last_item['paymentAmountCur'];
			$row['contractItemsNo_2']=$last_item['contractItemsNo'];
			$row['paymentItemsNo_2']=$last_item['paymentItemsNo']; 
			
			
          		
				
	    }
	
        else
		if (strpos($row['link'],'/khmdhs/') !== false ) 	{ //KHMDHS
			$row['dk_flag']='k';
			$row['link'] =  str_replace('khmdhs','diaugeiakhmdhs', $row['link'] );
			$row['address'] =  $last_item['address'];			
			$row['pc'] =  $last_item['pc'];
			$row['city'] =  $last_item['city'];
			$row['lastUpdate_2']=$last_item['lastUpdate'];
			//echo $row['lastUpdate_2'];
			
			$row['award0_2']=$last_item['award0'];
			$row['award1_2']=$last_item['award1'];	
			$row['award2_2']=$last_item['award2'];	
			$row['awardCnt0_2']=$last_item['awardCnt0'];	
			$row['awardCnt1_2']=$last_item['awardCnt1'];	
			$row['awardCnt2_2']=$last_item['awardCnt2'];			  
			$row['spend0_2']=$last_item['spend0'];
			$row['spend1_2']=$last_item['spend1'];
			$row['spend2_2']=$last_item['spend2'];
			$row['spendCnt0_2']=$last_item['spendCnt0'];
			$row['spendCnt1_2']=$last_item['spendCnt1'];
			$row['spendCnt2_2']=$last_item['spendCnt2'];
	
		}
	
	  //  $row['score'] = $row['score'] + $last_item['score']; //boost step 3
	  $row['relative1'] = $last_item['score']; //boost step 3
	
    }	
	/* if	(
	( substr($row['id'],strpos($row['id'], "?=") ) == substr($last_item['id'],strpos($last_item['id'], "?=") ))
	 && 
	 (substr($last_item_2['id'],strpos($last_item_2['id'], "?=") ) == (substr($last_item['id'],strpos($last_item['id'], "?=") )))
	 )
	 {
		   //echo 'found:'.substr($row['id'],strpos($row['id'], "?=") );
		  // echo 'found:'.substr($last_item_2['id'],strpos($last_item_2['id'], "?=") );
		   $double[]=$last_item_2;
		 //  if (strpos($row['link'],'/diaugeia/') !== false ) { //DIAUGEIA
		//echo $row['link'];
			$row['dk_flag']='d';
			$row['link'] =  str_replace('diaugeia','diaugeiakhmdhs', $row['link'] );	
			
			$row['lastUpdate_2']=$last_item_2['lastUpdate'];
			
			$row['contractAmountPrev_2']=$last_item_2['contractAmountPrev'];
			$row['contractAmountCur_2']=$last_item_2['contractAmountCur'];
			$row['paymentAmountPrev_2']=$last_item_2['paymentAmountPrev'];
			$row['paymentAmountCur_2']=$last_item_2['paymentAmountCur'];
			$row['contractItemsNo_2']=$last_item_2['contractItemsNo'];
			$row['paymentItemsNo_2']=$last_item_2['paymentItemsNo']; 
			
			$row['award0_2']=$last_item_2['award0'];
			$row['award1_2']=$last_item_2['award1'];	
			$row['award2_2']=$last_item_2['award2'];	
			$row['awardCnt0_2']=$last_item_2['awardCnt0'];	
			$row['awardCnt1_2']=$last_item_2['awardCnt1'];	
			$row['awardCnt2_2']=$last_item_2['awardCnt2'];			  
			$row['spend0_2']=$last_item_2['spend0'];
			$row['spend1_2']=$last_item_2['spend1'];
			$row['spend2_2']=$last_item_2['spend2'];
			$row['spendCnt0_2']=$last_item_2['spendCnt0'];
			$row['spendCnt1_2']=$last_item_2['spendCnt1'];
			$row['spendCnt2_2']=$last_item_2['spendCnt2'];
		//	}
		   //echo $last_item_2['link'].'ok!<br>';
		   } */
	//echo 'current '.$row['id'].'<br>';
	//echo 'prev '.$last_item['id'].'<br>';
    if(++$c !== $numItems) {
    //echo "not last index!";
	$last_item = $row;
	$last_item_2 = $last_item;
    }
	
	
}
//print_r($double);
$c = 0;
$toMerge=0;


//$sort = array();

/////////////////hybrid///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach ($uniqueResults as $key => &$row){
 $sort['id'][$key] = substr($row['id'],strpos($row['id'], "?=") );
 $sort['link'][$key] = $row['link'];
}
array_multisort($sort['id'], SORT_ASC, $sort['link'], SORT_ASC,$uniqueResults );

foreach ($uniqueResults as $key => &$row){
//echo $row['link'].'<br>';

if (strpos($row['link'],'zdiaugeia') !== false){
 //echo $row['score'].'<br>'; 
 //$row['score'] *=3;
 
 //echo $row['link'].'<br>';
 //echo $row['score'].'<br>';
	if	((substr($row['id'],strpos($row['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") )))
	{
	//echo $last_item['id'].'<br>';
	if ($row['relative1']==0) $row['relative1']=$last_item['score']; //boost rel1
	if ((strpos($last_item['link'],'/diaugeia/') !== false ) || (strpos($last_item['link'],'/diaugeiakhmdhs/') !== false ) )
	$double[]=$last_item;
    if (strpos($last_item['link'],'/khmdhs/') !== false ) {
	$double[]=$last_item;
	if (strpos($last_item['link'],'seller')!== false){
		$row['linkHKS']=$last_item['link'];		
		$row['contractAmountPrevHKS']=$last_item['contractAmountPrev']; 
		$row['contractAmountCurHKS']=$last_item['contractAmountCur'];
		$row['paymentAmountPrevHKS']=$last_item['paymentAmountPrev'];
		$row['paymentAmountCurHKS']=$last_item['paymentAmountCur'];
		$row['contractItemsNoHKS']=$last_item['contractItemsNo'];
		$row['paymentItemsNoHKS']=$last_item['paymentItemsNo'];
		$row['lastUpdateHKS']=$last_item['lastUpdate'];	 		
		}
	else{
	    $row['linkHKB']=$last_item['link'];	
		$row['contractAmountPrevHKB']=$last_item['contractAmountPrev']; 
		$row['contractAmountCurHKB']=$last_item['contractAmountCur'];
		$row['paymentAmountPrevHKB']=$last_item['paymentAmountPrev'];
		$row['paymentAmountCurHKB']=$last_item['paymentAmountCur'];
		$row['contractItemsNoHKB']=$last_item['contractItemsNo'];
		$row['paymentItemsNoHKB']=$last_item['paymentItemsNo'];	 
		$row['lastUpdateHKB']=$last_item['lastUpdate'];	 
	 }
    }	
			
	if ((substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") )))
		{	
	    $row['relative2']=$last_item_2['score']; //boost rel2
		//echo $last_item_2['id'].'<br>';
		if ((strpos($last_item_2['link'],'/diaugeia/') !== false ) || (strpos($last_item_2['link'],'/diaugeiakhmdhs/') !== false ) )
		$double[]=$last_item_2;
		if (strpos($last_item_2['link'],'/khmdhs/') !== false ) {
		$double[]=$last_item_2;
		if (strpos($last_item_2['link'],'seller')!== false){
			$row['linkHKS']=$last_item_2['link'];			
			$row['contractAmountPrevHKS']=$last_item_2['contractAmountPrev']; 
			$row['contractAmountCurHKS']=$last_item_2['contractAmountCur'];
			$row['paymentAmountPrevHKS']=$last_item_2['paymentAmountPrev'];
			$row['paymentAmountCurHKS']=$last_item_2['paymentAmountCur'];
			$row['contractItemsNoHKS']=$last_item_2['contractItemsNo'];
			$row['paymentItemsNoHKS']=$last_item_2['paymentItemsNo'];
			$row['lastUpdateHKS']=$last_item_2['lastUpdate'];	 
		}
		else {
			$row['linkHKB']=$last_item_2['link'];
			$row['contractAmountPrevHKB']=$last_item_2['contractAmountPrev']; 
			$row['contractAmountCurHKB']=$last_item_2['contractAmountCur'];
			$row['paymentAmountPrevHKB']=$last_item_2['paymentAmountPrev'];
			$row['paymentAmountCurHKB']=$last_item_2['paymentAmountCur'];
			$row['contractItemsNoHKB']=$last_item_2['contractItemsNo'];
			$row['paymentItemsNoHKB']=$last_item_2['paymentItemsNo'];	 
			$row['lastUpdateHKB']=$last_item_2['lastUpdate'];	 
		}
		}
			if ((substr($last_item_3['id'],strpos($last_item_3['id'], "?=") )) == (substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )))
			{
				$row['relative3']=$last_item_3['score']; //boost rel3
			   // echo $last_item_3['id'].'<br>';
				if ((strpos($last_item_3['link'],'/diaugeia/') !== false ) || (strpos($last_item_3['link'],'/diaugeiakhmdhs/') !== false ) )
				$double[]=$last_item_3;
				if (strpos($last_item_3['link'],'/khmdhs/') !== false ) {
				$double[]=$last_item_3;
				if (strpos($last_item_3['link'],'seller')!== false){
					$row['linkHKS']=$last_item_3['link'];						
					$row['contractAmountPrevHKS']=$last_item_3['contractAmountPrev']; 
					$row['contractAmountCurHKS']=$last_item_3['contractAmountCur'];
					$row['paymentAmountPrevHKS']=$last_item_3['paymentAmountPrev'];
					$row['paymentAmountCurHKS']=$last_item_3['paymentAmountCur'];
					$row['contractItemsNoHKS']=$last_item_3['contractItemsNo'];
					$row['paymentItemsNoHKS']=$last_item_3['paymentItemsNo'];
					$row['lastUpdateHKS']=$last_item_3['lastUpdate'];	 
                }				
				else
				{
					$row['linkHKB']=$last_item_3['link'];
					$row['contractAmountPrevHKB']=$last_item_3['contractAmountPrev']; 
					$row['contractAmountCurHKB']=$last_item_3['contractAmountCur'];
					$row['paymentAmountPrevHKB']=$last_item_3['paymentAmountPrev'];
					$row['paymentAmountCurHKB']=$last_item_3['paymentAmountCur'];
					$row['contractItemsNoHKB']=$last_item_3['contractItemsNo'];
					$row['paymentItemsNoHKB']=$last_item_3['paymentItemsNo'];	 
					$row['lastUpdateHKB']=$last_item_3['lastUpdate'];	 
				}
				}
				if ((substr($last_item_4['id'],strpos($last_item_4['id'], "?=") )) == (substr($last_item_3['id'],strpos($last_item_3['id'], "?=") ))){
				//echo $last_item_4['id'].'<br>';
				$row['relative4']=$last_item_4['score']; //boost rel4
				if ((strpos($last_item_4['link'],'/diaugeia/') !== false ) || (strpos($last_item_4['link'],'/diaugeiakhmdhs/') !== false ) )
				$double[]=$last_item_4;
				if (strpos($last_item_4['link'],'/khmdhs/') !== false ) {
				$double[]=$last_item_4;
				if (strpos($last_item_4['link'],'seller')!== false){
					$row['linkHKS']=$last_item_4['link'];						
					$row['contractAmountPrevHKS']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurHKS']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevHKS']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurHKS']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoHKS']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoHKS']=$last_item_4['paymentItemsNo'];
					$row['lastUpdateHKS']=$last_item_4['lastUpdate'];	 
                }				
				else
				{
					$row['linkHKB']=$last_item_4['link'];
					$row['contractAmountPrevHKB']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurHKB']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevHKB']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurHKB']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoHKB']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoHKB']=$last_item_4['paymentItemsNo'];	 
					$row['lastUpdateHKB']=$last_item_4['lastUpdate'];	 
				}
				
			    	}
				
				}
			}
		}
    }
		
}
 if(++$c !== $numItems) {
    //echo "not last index!";
	$last_item_4=$last_item_3;
	$last_item_3=$last_item_2;
	$last_item_2=$last_item;
	$last_item = $row;
    }
} 

/////////Espa///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

foreach ($uniqueResults as $key => &$row){
 $sort['id'][$key] = substr($row['id'],strpos($row['id'], "?=") );
 $sort['link'][$key] = $row['link'];
}
array_multisort($sort['id'], SORT_ASC, $sort['link'], SORT_ASC,$uniqueResults );

foreach ($uniqueResults as $key => &$row){
//echo 'r='.$row['link'].'<br>';
//echo 'l='.$last_item['link'].'<br>';
//echo 'l2='.$last_item_2['link'].'<br>';
//echo 'l3='.$last_item_3['link'].'<br>';
//echo 'l4='.$last_item_4['link'].'<br>';

if    ((strpos($row['link'],'espa') !== false) ||(strpos($row['link'],'beneficiary') !== false)){
     
	if	((substr($row['id'],strpos($row['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") )))
	{
	$row['relative1']=$last_item['score'];
	
	// echo $row['score'].'<br>'; 
    // $row['score'] *=3;
	 
     //echo $row['link'].'<br>';
     //echo $row['score'].'<br>';
	//echo '1'.$last_item['link'].'<br>';
	if ((strpos($last_item['link'],'/diaugeia/') !== false ) || (strpos($last_item['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item['link'],'hybrid') !== false )){
	$double[]=$last_item; //for hide
	
	
	   if (strpos($last_item['link'],'seller')!== false){
	   $row['linkEDS']=$last_item['link'];	
	   $row['award0EDS']=$last_item['award0']; 
	   $row['award1EDS']=$last_item['award1'];
	   $row['award2EDS']=$last_item['award2'];
	   $row['awardCnt0EDS']=$last_item['awardCnt0'];
	   $row['awardCnt1EDS']=$last_item['awardCnt1'];
	   $row['awardCnt2EDS']=$last_item['awardCnt2'];
       $row['spend0EDS']=$last_item['spend0'];	
	   $row['spend1EDS']=$last_item['spend1'];
       $row['spend2EDS']=$last_item['spend2']; 	   
	   $row['spendCnt0EDS']=$last_item['spendCnt0']; 
	   $row['spendCnt1EDS']=$last_item['spendCnt1'];
       $row['spendCnt2EDS']=$last_item['spendCnt2'];
       $row['lastUpdateEDS']=$last_item['lastUpdate'];        	  
	       
	      
	   }
	   else{
	   $row['linkEDB']=$last_item['link'];	
	   $row['award0EDB']=$last_item['award0']; 
	   $row['award1EDB']=$last_item['award1'];
	   $row['award2EDB']=$last_item['award2'];
	   $row['awardCnt0EDB']=$last_item['awardCnt0'];
	   $row['awardCnt1EDB']=$last_item['awardCnt1'];
	   $row['awardCnt2EDB']=$last_item['awardCnt2'];
       $row['spend0EDB']=$last_item['spend0'];	
	   $row['spend1EDB']=$last_item['spend1'];
       $row['spend2EDB']=$last_item['spend2']; 	   
	   $row['spendCnt0EDB']=$last_item['spendCnt0']; 
	   $row['spendCnt1EDB']=$last_item['spendCnt1'];
       $row['spendCnt2EDB']=$last_item['spendCnt2'];
	   $row['lastUpdateEDB']=$last_item['lastUpdate'];	
	   }
	}
    if (strpos($last_item['link'],'/khmdhs/') !== false ) {
	$double[]=$last_item; // for hide
	if (strpos($last_item['link'],'seller')!== false){
		$row['linkEKS']=$last_item['link'];		
		$row['contractAmountPrevEKS']=$last_item['contractAmountPrev']; 
		$row['contractAmountCurEKS']=$last_item['contractAmountCur'];
		$row['paymentAmountPrevEKS']=$last_item['paymentAmountPrev'];
		$row['paymentAmountCurEKS']=$last_item['paymentAmountCur'];
		$row['contractItemsNoEKS']=$last_item['contractItemsNo'];
		$row['paymentItemsNoEKS']=$last_item['paymentItemsNo'];
		$row['lastUpdateEKS']=$last_item['lastUpdate'];	 		
		}
	else{
	    $row['linkEKB']=$last_item['link'];	
		$row['contractAmountPrevEKB']=$last_item['contractAmountPrev']; 
		$row['contractAmountCurEKB']=$last_item['contractAmountCur'];
		$row['paymentAmountPrevEKB']=$last_item['paymentAmountPrev'];
		$row['paymentAmountCurEKB']=$last_item['paymentAmountCur'];
		$row['contractItemsNoEKB']=$last_item['contractItemsNo'];
		$row['paymentItemsNoEKB']=$last_item['paymentItemsNo'];	 
		$row['lastUpdateEKB']=$last_item['lastUpdate'];	 
	 }
    }	
			
	if ((substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )) == (substr($last_item['id'],strpos($last_item['id'], "?=") )))
		{	
		//echo '2'.$last_item_2['link'].'<br>';
		$row['relative2']=$last_item_2['score'];
		
		if ((strpos($last_item_2['link'],'/diaugeia/') !== false ) || (strpos($last_item_2['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_2['link'],'hybrid') !== false )){
		 $double[]=$last_item_2; //for hide
		 
			if (strpos($last_item_2['link'],'seller')!== false){
			$row['linkEDS']=$last_item_2['link'];	
	        $row['award0EDS']=$last_item_2['award0']; 
	        $row['award1EDS']=$last_item_2['award1'];
	        $row['award2EDS']=$last_item_2['award2'];
	        $row['awardCnt0EDS']=$last_item_2['awardCnt0'];
	        $row['awardCnt1EDS']=$last_item_2['awardCnt1'];
	        $row['awardCnt2EDS']=$last_item_2['awardCnt2'];
            $row['spend0EDS']=$last_item_2['spend0'];	
	        $row['spend1EDS']=$last_item_2['spend1'];
            $row['spend2EDS']=$last_item_2['spend2']; 	   
	        $row['spendCnt0EDS']=$last_item_2['spendCnt0']; 
	        $row['spendCnt1EDS']=$last_item_2['spendCnt1'];
            $row['spendCnt2EDS']=$last_item_2['spendCnt2'];
            $row['lastUpdateEDS']=$last_item_2['lastUpdate'];   			
	   
			}
			else{
			$row['linkEDB']=$last_item_2['link'];	
			$row['award0EDB']=$last_item_2['award0']; 
	        $row['award1EDB']=$last_item_2['award1'];
	        $row['award2EDB']=$last_item_2['award2'];
	        $row['awardCnt0EDB']=$last_item_2['awardCnt0'];
	        $row['awardCnt1EDB']=$last_item_2['awardCnt1'];
	        $row['awardCnt2EDB']=$last_item_2['awardCnt2'];
            $row['spend0EDB']=$last_item_2['spend0'];	
	        $row['spend1EDB']=$last_item_2['spend1'];
            $row['spend2EDB']=$last_item_2['spend2']; 	   
	        $row['spendCnt0EDB']=$last_item_2['spendCnt0']; 
	        $row['spendCnt1EDB']=$last_item_2['spendCnt1'];
            $row['spendCnt2EDB']=$last_item_2['spendCnt2'];
			$row['lastUpdateEDB']=$last_item_2['lastUpdate'];	 
			}
		
		}
		if (strpos($last_item_2['link'],'/khmdhs/') !== false ) {
		$double[]=$last_item_2;
		if (strpos($last_item_2['link'],'seller')!== false){
			$row['linkEKS']=$last_item_2['link'];			
			$row['contractAmountPrevEKS']=$last_item_2['contractAmountPrev']; 
			$row['contractAmountCurEKS']=$last_item_2['contractAmountCur'];
			$row['paymentAmountPrevEKS']=$last_item_2['paymentAmountPrev'];
			$row['paymentAmountCurEKS']=$last_item_2['paymentAmountCur'];
			$row['contractItemsNoEKS']=$last_item_2['contractItemsNo'];
			$row['paymentItemsNoEKS']=$last_item_2['paymentItemsNo'];
			$row['lastUpdateEKS']=$last_item_2['lastUpdate'];	 
		}
		else {
			$row['linkEKB']=$last_item_2['link'];
			$row['contractAmountPrevEKB']=$last_item_2['contractAmountPrev']; 
			$row['contractAmountCurEKB']=$last_item_2['contractAmountCur'];
			$row['paymentAmountPrevEKB']=$last_item_2['paymentAmountPrev'];
			$row['paymentAmountCurEKB']=$last_item_2['paymentAmountCur'];
			$row['contractItemsNoEKB']=$last_item_2['contractItemsNo'];
			$row['paymentItemsNoEKB']=$last_item_2['paymentItemsNo'];	 
			$row['lastUpdateEKB']=$last_item_2['lastUpdate'];	 
		}
		}
		 	if ((substr($last_item_3['id'],strpos($last_item_3['id'], "?=") )) == (substr($last_item_2['id'],strpos($last_item_2['id'], "?=") )))
			{
			$row['relative3']=$last_item_2['score'];
			   //echo '3'.$last_item_3['link'].'<br>';
				if ((strpos($last_item_3['link'],'/diaugeia/') !== false ) || (strpos($last_item_3['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_3['link'],'hybrid') !== false ) ){
				$double[]=$last_item_3;
					if (strpos($last_item_3['link'],'seller')!== false){
					$row['linkEDS']=$last_item_3['link'];	
					$row['award0EDS']=$last_item_3['award0']; 
					$row['award1EDS']=$last_item_3['award1'];
					$row['award2EDS']=$last_item_3['award2'];
					$row['awardCnt0EDS']=$last_item_3['awardCnt0'];
					$row['awardCnt1EDS']=$last_item_3['awardCnt1'];
					$row['awardCnt2EDS']=$last_item_3['awardCnt2'];
					$row['spend0EDS']=$last_item_3['spend0'];	
					$row['spend1EDS']=$last_item_3['spend1'];
					$row['spend2EDS']=$last_item_3['spend2']; 	   
					$row['spendCnt0EDS']=$last_item_3['spendCnt0']; 
					$row['spendCnt1EDS']=$last_item_3['spendCnt1'];
					$row['spendCnt2EDS']=$last_item_3['spendCnt2'];
					$row['lastUpdateEDS']=$last_item_3['lastUpdate'];  			
	   
					}
			    else{
			        $row['linkEDB']=$last_item_3['link'];	
				    $row['award0EDB']=$last_item_3['award0']; 
	                $row['award1EDB']=$last_item_3['award1'];
	                $row['award2EDB']=$last_item_3['award2'];
	                $row['awardCnt0EDB']=$last_item_3['awardCnt0'];
	                $row['awardCnt1EDB']=$last_item_3['awardCnt1'];
	                $row['awardCnt2EDB']=$last_item_3['awardCnt2'];
                    $row['spend0EDB']=$last_item_3['spend0'];	
	                $row['spend1EDB']=$last_item_3['spend1'];
                    $row['spend2EDB']=$last_item_3['spend2']; 	   
	                $row['spendCnt0EDB']=$last_item_3['spendCnt0']; 
	                $row['spendCnt1EDB']=$last_item_3['spendCnt1'];
                    $row['spendCnt2EDB']=$last_item_3['spendCnt2'];
			        $row['lastUpdateEDB']=$last_item_3['lastUpdate'];	 
			        }
				
				
				}
				if (strpos($last_item_3['link'],'/khmdhs/') !== false ) {
				$double[]=$last_item_3;
				if (strpos($last_item_3['link'],'seller')!== false){
					$row['linkEKS']=$last_item_3['link'];						
					$row['contractAmountPrevEKS']=$last_item_3['contractAmountPrev']; 
					$row['contractAmountCurEKS']=$last_item_3['contractAmountCur'];
					$row['paymentAmountPrevEKS']=$last_item_3['paymentAmountPrev'];
					$row['paymentAmountCurEKS']=$last_item_3['paymentAmountCur'];
					$row['contractItemsNoEKS']=$last_item_3['contractItemsNo'];
					$row['paymentItemsNoEKS']=$last_item_3['paymentItemsNo'];
					$row['lastUpdateEKS']=$last_item_3['lastUpdate'];	 
                }				
				else
				{
					$row['linkEKB']=$last_item_3['link'];
					$row['contractAmountPrevEKB']=$last_item_3['contractAmountPrev']; 
					$row['contractAmountCurEKB']=$last_item_3['contractAmountCur'];
					$row['paymentAmountPrevEKB']=$last_item_3['paymentAmountPrev'];
					$row['paymentAmountCurEKB']=$last_item_3['paymentAmountCur'];
					$row['contractItemsNoEKB']=$last_item_3['contractItemsNo'];
					$row['paymentItemsNoEKB']=$last_item_3['paymentItemsNo'];	 
					$row['lastUpdateEKB']=$last_item_3['lastUpdate'];	 
				}
				}
				
				if ((substr($last_item_4['id'],strpos($last_item_4['id'], "?=") )) == (substr($last_item_3['id'],strpos($last_item_3['id'], "?=") ))){
			//	echo '4'.$last_item_4['link'].'<br>';
			$row['relative4']=$last_item_3['score'];
				  if ((strpos($last_item_4['link'],'/diaugeia/') !== false ) || (strpos($last_item_4['link'],'/diaugeiakhmdhs/') !== false ) || (strpos($last_item_4['link'],'hybrid') !== false ) ){				
			    	$double[]=$last_item_4;
				    if (strpos($last_item_4['link'],'seller')!== false){
						$row['linkEDS']=$last_item_4['link'];	
						$row['award0EDS']=$last_item_4['award0']; 
						$row['award1EDS']=$last_item_4['award1'];
						$row['award2EDS']=$last_item_4['award2'];
						$row['awardCnt0EDS']=$last_item_4['awardCnt0'];
						$row['awardCnt1EDS']=$last_item_4['awardCnt1'];
						$row['awardCnt2EDS']=$last_item_4['awardCnt2'];
						$row['spend0EDS']=$last_item_4['spend0'];	
						$row['spend1EDS']=$last_item_4['spend1'];
						$row['spend2EDS']=$last_item_4['spend2']; 	   
						$row['spendCnt0EDS']=$last_item_4['spendCnt0']; 
						$row['spendCnt1EDS']=$last_item_4['spendCnt1'];
						$row['spendCnt2EDS']=$last_item_4['spendCnt2'];
						$row['lastUpdateEDS']=$last_item_4['lastUpdate'];  			
	   
					}
			          else{
			          $row['linkEDB']=$last_item_4['link'];	
				      $row['award0EDB']=$last_item_4['award0']; 
	                  $row['award1EDB']=$last_item_4['award1'];
	                  $row['award2EDB']=$last_item_4['award2'];
	                  $row['awardCnt0EDB']=$last_item_4['awardCnt0'];
	                  $row['awardCnt1EDB']=$last_item_4['awardCnt1'];
	                  $row['awardCnt2EDB']=$last_item_4['awardCnt2'];
                      $row['spend0EDB']=$last_item_4['spend0'];	
	                  $row['spend1EDB']=$last_item_4['spend1'];
                      $row['spend2EDB']=$last_item_4['spend2']; 	   
	                  $row['spendCnt0EDB']=$last_item_4['spendCnt0']; 
	                  $row['spendCnt1EDB']=$last_item_4['spendCnt1'];
                      $row['spendCnt2EDB']=$last_item_4['spendCnt2'];
			          $row['lastUpdateEDB']=$last_item_4['lastUpdate'];	 
			        }
				
				
			     }
				  if (strpos($last_item_4['link'],'/khmdhs/') !== false ) {
				$double[]=$last_item_4;
				if (strpos($last_item_4['link'],'seller')!== false){
					$row['linkEKS']=$last_item_4['link'];						
					$row['contractAmountPrevEKS']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurEKS']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevEKS']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurEKS']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoEKS']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoEKS']=$last_item_4['paymentItemsNo'];
					$row['lastUpdateEKS']=$last_item_4['lastUpdate'];	 
                }				
				else
				{
					$row['linkEKB']=$last_item_4['link'];
					$row['contractAmountPrevEKB']=$last_item_4['contractAmountPrev']; 
					$row['contractAmountCurEKB']=$last_item_4['contractAmountCur'];
					$row['paymentAmountPrevEKB']=$last_item_4['paymentAmountPrev'];
					$row['paymentAmountCurEKB']=$last_item_4['paymentAmountCur'];
					$row['contractItemsNoEKB']=$last_item_4['contractItemsNo'];
					$row['paymentItemsNoEKB']=$last_item_4['paymentItemsNo'];	 
					$row['lastUpdateEKB']=$last_item_4['lastUpdate'];	 
				}
				
			    	}
				
				} 
			} //end of last item3, 4 
		}
    }
		
}
 if(++$c !== $numItems) {
    //echo "not last index!";
	$last_item_4=$last_item_3;
	$last_item_3=$last_item_2;
	$last_item_2=$last_item;
	$last_item = $row;
    }
}

 
//print_r($double);
$i = 0;
$sumResults=count($uniqueResults);
$sumSpend=0;
$sumAward=0;
$sumContracts=0;
$sumPayments=0;
$counterContracts=0;
$sumAwardSel=0;
$sumSpendSel=0;




echo "<table id='searchResults' class='display'  ><thead><tr><th></th></th></th> </tr></thead>";  

echo "<tbody>";
while ($i<$sumResults) { 

//penalize vat missing
if  (!is_numeric($uniqueResults[$i]['vat'])) { //boost step 2
//echo $uniqueResults[$i]['score'].'<br>';
$uniqueResults[$i]['score'] = bcmul(0.75,$uniqueResults[$i]['score'] ,4) ;
//$row['score'] *=1;

}


if  ( (isset($uniqueResults[$i]['link'])) 
				&& 
	(strpos($uniqueResults[$i]['link'],'person') == false) 
			&&  
	($this->hideDuplicate($double,$uniqueResults[$i]['link'])!= 1) 
	     //     &&  
//((hideDuplicate($hidden,$uniqueResults[$i]['link'])!= 1) &&($toMerge>1) ) 
	) { 
      

$link=($uniqueResults[$i]['link']);
//fix hybrid link
if   (strpos($link,'zdiaugeia/diaugeia-hybrids') !== false)
$link=str_replace('zdiaugeia/','diaugeia/',$link);

//generate espa link http://83.212.86.158:5984/elod_espa_beneficiaries/_design/all/_view/all
if (($uniqueResults[$i]['pageKind']) =='sellerBoth')
$link= str_replace('zorganization-beneficiary','espa-both-organization-seller',$link); //diaugeiakhmdhs+diaugeiakhmdhs+espa
else
if (($uniqueResults[$i]['pageKind']) =='buyerBoth')
$link= str_replace('zorganization-beneficiary','espa-both-organization-buyer',$link); //diaugeiakhmdhs+diaugeiakhmdhs+espa
else
if (($uniqueResults[$i]['pageKind']) =='sellerDiavgeia')
$link= str_replace('zorganization-beneficiary','espa-diavgeia-organization-seller',$link); //diaugeia+espa
else
if (($uniqueResults[$i]['pageKind']) =='buyerDiavgeia')
$link= str_replace('zorganization-beneficiary','espa-diavgeia-organization-buyer',$link); //diaugeia+espa
else
if (($uniqueResults[$i]['pageKind']) =='sellerKhmdhs')
$link= str_replace('zorganization-beneficiary','espa-khmdhs-organization-seller',$link); //khmdhs+espa
else
if (($uniqueResults[$i]['pageKind']) =='buyerKhmdhs')
$link= str_replace('zorganization-beneficiary','espa-khmdhs-organization-buyer',$link); //khmdhs+espa
else if  ((($uniqueResults[$i]['pageKind']) =='') || (($uniqueResults[$i]['pageKind']) =='general'))
$link= str_replace('zorganization-beneficiary','organization-beneficiary',$link);

$nameLink=$link;
$name=$uniqueResults[$i]['name'];
$psName=$uniqueResults[$i]['psName'];



if    ((strpos($link,'seller') !== false) && (strpos($link,'espa') == false)) {
$property='ΑΝΑΔΟΧΟΣ';
}
else 
if    ((strpos($link,'buyer') !== false)&& (strpos($link,'espa') == false)){
$property='ΦΟΡΕΑΣ';
}
else 
if    (strpos($link,'hybrid') !== false){
$property='ΥΒΡΙΔΙΚΟΣ';
}
else 
if    ((strpos($link,'espa') !== false) ||(strpos($link,'beneficiary') !== false)){
$property='ΔΙΚΑΙΟΥΧΟΣ';
}
else 
if (strpos($link,'cpv') !== false) {
	if ($uniqueResults[$i]['cpvLabel']=='sub')
    $property='Υποκατηγορία';
	else
	$property='Κύρια Κατηγορία';
}

else 
$property=' ';

echo "<tr>";

if  	(strpos($link,'diaugeia/org') !== false)   { //διαυγεια 035970655
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
	//echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
	//echo '<B>'.$name.'</B><br>';
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
	//echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	//echo  '<B>'.(getSource($link,'d')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
	//echo '<B>';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
	echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
	//echo '</B>';
	echo  'Οριστικοποίηση Πληρωμών: ';
		$sumSpend=$this->fromTextToNumber($uniqueResults[$i]['spend0']) + $this->fromTextToNumber($uniqueResults[$i]['spend1']) + $this->fromTextToNumber($uniqueResults[$i]['spend2'])  ;
	echo '<B> '.$this->fromNumberToText($sumSpend,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0']+$uniqueResults[$i]['spendCnt1']+$uniqueResults[$i]['spendCnt2']),0).'</B>) '; 
	echo  'Κατακυρώσεις: ';
		$sumAward=$this->fromTextToNumber($uniqueResults[$i]['award0']) + $this->fromTextToNumber($uniqueResults[$i]['award1']) + $this->fromTextToNumber($uniqueResults[$i]['award2'])  ;
	echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>) '; 
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
} 
else if ((strpos($link,'espa') !== false) ||(strpos($link,'beneficiary') !== false) )    {
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	
	//echo '<B>'.$name.'</B><br>';
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";
	/*echo 'r1='.$uniqueResults[$i]['relative1'].'<br>';
	echo 'r2='.$uniqueResults[$i]['relative2'].'<br>';
	echo 'r3='.$uniqueResults[$i]['relative3'].'<br>';
	echo 'r4='.$uniqueResults[$i]['relative4'].'<br>';*/
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	
	if (($uniqueResults[$i]['pageKind']) =='sellerBoth'){ //eg 999243471 099360290
	
	
	
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
	$link4=$uniqueResults[$i]['linkEDB'];   
    if ((isset($link4)) && ($link4 !== ' ')) {	//missing buyer for 099360290
		//echo $link4."</br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
		//echo "<a href='".$link4."'target='_blank' fontcolor='#FFA500' size='1' > <B>Φορέας </B></a> ";
		echo "<a href='".$link4."'target='_blank' style='font-size: 10px; color: #FFA500;'  <B>ΦΟΡΕΑΣ</B> </a> ";
		//echo ' <font color="#FFA500" size="1">Ανάδοχος</font> '; 
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend= $this->fromTextToNumber($uniqueResults[$i]['spend0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDB'])  ;
		echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDB']+$uniqueResults[$i]['spendCnt1EDB']+$uniqueResults[$i]['spendCnt2EDB']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDB'])  ;
		echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDB']+$uniqueResults[$i]['awardCnt1EDB']+$uniqueResults[$i]['awardCnt2EDB']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDB'].']</br>';
	    }
	
	
	
	
	$link2=$uniqueResults[$i]['linkEDS'];   //must be diaugeiakhmdhs
    if ((isset($link2)) && ($link2 !== ' ')){	
		//echo $link2."</br>"; 	
		//echo '<B>';		
	    echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ</font> '; 
		//echo '</B>';
        echo  'Οριστικοποίηση Πληρωμών: ';
			$sumSpend = $this->fromTextToNumber($uniqueResults[$i]['spend0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDS'])  ;
	    echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
	    echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDS']+$uniqueResults[$i]['spendCnt1EDS']+$uniqueResults[$i]['spendCnt2EDS']),0).'</B>) '; 
    	echo  'Κατακυρώσεις: ';
			$sumAward = $this->fromTextToNumber($uniqueResults[$i]['award0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDS'])  ;
	    echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
	    echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDS']+$uniqueResults[$i]['awardCnt1EDS']+$uniqueResults[$i]['awardCnt2EDS']),0).'</B>) '; 
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDS'].']</br>';			
        }		
    $link3 = $uniqueResults[$i]['linkEKS'];   
    if ((isset($link3)) && ($link3 !== ' ')) {	
		//echo $link3."</br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> ';
		//echo '<B>';
	    echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ</font> '; 
		//echo '</B>';
		echo  'Συμβάσεις: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevEKS']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurEKS'])  ;
		echo '<B>'.$this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoEKS']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments =  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevEKS']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurEKS'])  ;
		echo '<B>'.$this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoEKS']),0).'</B>) ';		
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEKS'].']</br>';	
	    }
	}
	else
	if (($uniqueResults[$i]['pageKind']) =='buyerBoth'){ //eg 090050779 χάνουμε τον  πιθανο seller -fixed 090050779 double problem
	$link2=$uniqueResults[$i]['linkEDB']; 
	if ((isset($link2)) && ($link2 !== ' ')){
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
		//echo '<B>';
		echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ</font> '; 
		//echo '</B>';
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend = $this->fromTextToNumber($uniqueResults[$i]['spend0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDB'])  ;
		echo '<B> '.fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDB']+$uniqueResults[$i]['spendCnt1EDB']+$uniqueResults[$i]['spendCnt2EDB']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDB'])  ;
		echo  '<B> '.fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDB']+$uniqueResults[$i]['awardCnt1EDB']+$uniqueResults[$i]['awardCnt2EDB']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDB'].']</br>';
	}
	$link4=$uniqueResults[$i]['linkEDS'];   
    if ((isset($link4)) && ($link4 !== ' ')) {	//test for missing seller, works
		//echo $link4."</br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
		echo "<a href='".$link4."'target='_blank' style='font-size: 10px; color: #FFA500;'  <B>ΑΝΑΔΟΧΟΣ</B> </a> ";
		//echo ' <font color="#FFA500" size="1">Ανάδοχος</font> '; 
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend = $this->fromTextToNumber($uniqueResults[$i]['spend0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDS'])  ;
		echo '<B> '.fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDS']+$uniqueResults[$i]['spendCnt1EDS']+$uniqueResults[$i]['spendCnt2EDS']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward = $this->fromTextToNumber($uniqueResults[$i]['award0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDS'])  ;
		echo  '<B> '.fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDS']+$uniqueResults[$i]['awardCnt1EDS']+$uniqueResults[$i]['awardCnt2EDS']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDS'].']</br>';
	    }
	
	$link3=$uniqueResults[$i]['linkEKB'];   
    if ((isset($link3)) && ($link3 !== ' ')) {	
		//echo $link4."</br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> ';
		//echo '<B>';
	    echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ</font> '; 
		//echo '</B>';
		echo  'Συμβάσεις: ';                                  
			$sumContracts=  $this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevEKB']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurEKB'])  ;
		echo '<B>'.  $this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoEKB']),0).'</B>) ';
		echo  'Πληρωμές: ';                           
			$sumPayments=  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevEKB']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurEKB'])  ;
		echo '<B>'.fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoEKB']),0).'</B>) ';		
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEKB'].']</br>';	
	    }
		
	
	
	}
	else
	if (($uniqueResults[$i]['pageKind']) =='sellerDiavgeia'){ //eg  004322968 012377598
	//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
	    //echo '<B>';
	    echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ</font> '; 
		//echo '</B>';
        echo  'Οριστικοποίηση Πληρωμών: ';
			$sumSpend=$this->fromTextToNumber($uniqueResults[$i]['spend0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDS'])  ;
	    echo '<B> '.$this->fromNumberToText($sumSpend,'€').'</B>';
	    echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDS']+$uniqueResults[$i]['spendCnt1EDS']+$uniqueResults[$i]['spendCnt2EDS']),0).'</B>) '; 
    	echo  'Κατακυρώσεις: ';
			$sumAward=$this->fromTextToNumber($uniqueResults[$i]['award0EDS']) + $this-> fromTextToNumber($uniqueResults[$i]['award1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDS'])  ;
	    echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
	    echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDS']+$uniqueResults[$i]['awardCnt1EDS']+$uniqueResults[$i]['awardCnt2EDS']),0).'</B>) '; 
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDS'].']</br>';	
	
	}
	else
	if (($uniqueResults[$i]['pageKind']) =='buyerDiavgeia'){ //eg 017130241 χανουμε τον seller (buyerdiaugeia ενω εχει seller) δεν δουλεύει 018133333 + double problem
	  //  echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
		//echo '<B>';
		echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ</font> '; 
		//echo '</B>';
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend=  $this->fromTextToNumber($uniqueResults[$i]['spend0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDB'])  ;
		echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDB']+$uniqueResults[$i]['spendCnt1EDB']+$uniqueResults[$i]['spendCnt2EDB']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDB'])  ;
		echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDB']+$uniqueResults[$i]['awardCnt1EDB']+$uniqueResults[$i]['awardCnt2EDB']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDB'].']</br>';
		
		$link2=$uniqueResults[$i]['linkEDS'];
		if ((isset($link2)) && ($link2 !== ' ')) {	//
		//echo $link4."</br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; //use namelink for superprofile
		echo "<a href='".$link2."'target='_blank' style='font-size: 10px; color: #FFA500;'  <B>ΑΝΑΔΟΧΟΣ</B> </a> ";
		//echo ' <font color="#FFA500" size="1">Ανάδοχος</font> '; 
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend=  $this->fromTextToNumber($uniqueResults[$i]['spend0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDS'])  ;
		echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDS']+$uniqueResults[$i]['spendCnt1EDS']+$uniqueResults[$i]['spendCnt2EDS']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDS']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDS'])  ;
		echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDS']+$uniqueResults[$i]['awardCnt1EDS']+$uniqueResults[$i]['awardCnt2EDS']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDS'].']</br>';
	    }
	
	}
	else
	if (($uniqueResults[$i]['pageKind']) =='sellerKhmdhs'){
	    //echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> ';
		//echo '<B>';
	    echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ</font> '; 
		//echo '</B>';
		echo  'Συμβάσεις: ';
			$sumContracts=  $this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevEKS']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurEKS'])  ;
		echo '<B>'.  $this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoEKS']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevEKS']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurEKS'])  ;
		echo '<B>'.  $this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoEKS']),0).'</B>) ';		
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEKS'].']</br>';	
	
	}
	if (($uniqueResults[$i]['pageKind']) =='buyerKhmdhs'){ //eg 090034024 buyerKhmdhs αλλα έχει και διαυγεια fixed
	    $link2=$uniqueResults[$i]['linkEDB'];
		if ((isset($link2)) && ($link2 !== ' ')){
		if (strpos($link2,'diaugeiakhmdhs') !== false) 		
		$link2=str_replace('diaugeiakhmdhs','diaugeia', $link2);
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
		//echo "<a href='".$link2."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>"; 
		//echo '<B>';
		echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ</font> '; 
		//echo '</B>';
		echo  'Οριστικοποίηση Πληρωμών: ';               
			$sumSpend=  $this->fromTextToNumber($uniqueResults[$i]['spend0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['spend2EDB'])  ;
		echo '<B> '.fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0EDB']+$uniqueResults[$i]['spendCnt1EDB']+$uniqueResults[$i]['spendCnt2EDB']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award1EDB']) + $this->fromTextToNumber($uniqueResults[$i]['award2EDB'])  ;
		echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0EDB']+$uniqueResults[$i]['awardCnt1EDB']+$uniqueResults[$i]['awardCnt2EDB']),0).'</B>) '; 
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEDB'].']</br>';			
		
		}
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> ';
	//	echo '<B>';
	    echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ</font> '; 
		//echo '<B>';
		echo  'Συμβάσεις: ';                                  
			$sumContracts=  $this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevEKB']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurEKB'])  ;
		echo '<B>'.  $this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoEKB']),0).'</B>) ';
		echo  'Πληρωμές: ';                           
			$sumPayments=  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevEKB']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurEKB'])  ;
		echo '<B>'.  $this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoEKB']),0).'</B>) ';		
	    echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateEKB'].']</br>';	
	}
	//only espa	
	//echo "<a href='".$nameLink."'target='_blank'  > <B>Στις ΕΠΙΔΟΤΗΣΕΙΣ ΕΣΠΑ</B></a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">Επιδοτήσεις ΕΣΠΑ</font></br> ';
	//echo '<B>';
	echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
	//echo '</B>';
	echo  'Συμβάσεις: ';
			//$sumContracts=fromTextToNumber($uniqueResults[$i]['contractAmountPrev']) + fromTextToNumber($uniqueResults[$i]['contractAmountCur'])  ;
		echo '<B>'.$uniqueResults[$i]['SubsContractsAmount'].'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['SubsContractsCounter']),0).'</B>) ';
		echo  'Πληρωμές: ';
			//$sumPayments=fromTextToNumber($uniqueResults[$i]['paymentAmountPrev']) + fromTextToNumber($uniqueResults[$i]['paymentAmountCur'])  ;
		echo '<B>'.$uniqueResults[$i]['SubsPaymentsAmount'].'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['SubsPaymentsCounter']),0).'</B>) ';
		
	echo  ' &nbsp [έως '.$this->convertDate($uniqueResults[$i]['lastUpdate']).']</br>';
	
	
	
    echo "</td>";
}
else if (strpos($link,'diaugeia/dia') !== false)   { //υβριδικος Διαύγεια + ελεγχος Κημδης 090166291
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
	//echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
	//echo '<B>'.$name.'</B><br>';
	//echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";
    /*echo 'r1='.$uniqueResults[$i]['relative1'].'<br>';
	echo 'r2='.$uniqueResults[$i]['relative2'].'<br>';
	echo 'r3='.$uniqueResults[$i]['relative3'].'<br>';
	echo 'r4='.$uniqueResults[$i]['relative4'].'<br>';	*/
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';	
	echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	//echo  '<B>ΣΤΗ ΔΙΑΥΓΕΙΑ<sup><font size="1">ΦΟΡΕΑΣ</font></sup> :  </B>'; 
	//echo  '<B>ΣΤΗ ΔΙΑΥΓΕΙΑ :  </B>';
	//echo 'Στη ';
	//echo "<a href='".$nameLink."'target='_blank' > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> '; 
	//echo '<B> ';
	echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ&nbsp </font> '; 
    //	echo '</B> ';
	echo  'Οριστικοποίηση Πληρωμών: ';
		  $sumSpend=
                  $this->fromTextToNumber($uniqueResults[$i]['spend0'])
		+ $this->fromTextToNumber($uniqueResults[$i]['spend1'])
		+ $this->fromTextToNumber($uniqueResults[$i]['spend2']) ;
	echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0']+$uniqueResults[$i]['spendCnt1']+$uniqueResults[$i]['spendCnt2']),0).'</B>) '; 
	echo  'Κατακυρώσεις: ';
		  $sumAward=
                  $this->fromTextToNumber($uniqueResults[$i]['award0'])
		+ $this->fromTextToNumber($uniqueResults[$i]['award1'])
		+ $this->fromTextToNumber($uniqueResults[$i]['award2'])  ;
	echo  '<B> '.  $this->fromNumberToText($sumAward,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>)';
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']<BR>';	
   // echo '<sup><font size="2">ΑΝΑΔΟΧΟΣ: </font></sup>';
    //echo '<B> ';
	echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ&nbsp </font> ';
    //echo ' <font color="#006621" font  size="1">ΑΝΑΔΟΧΟΣ&nbsp </font> '; 	
	//echo '</B> ';
	echo  'Οριστικοποίηση Πληρωμών: ';
		  $sumSpendSel=
                  $this->fromTextToNumber($uniqueResults[$i]['spendSel0'])
		+ $this->fromTextToNumber($uniqueResults[$i]['spendSel1'])
		+ $this->fromTextToNumber($uniqueResults[$i]['spendSel2']) ;
	echo '<B> '.  $this->fromNumberToText($sumSpendSel,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['spendCntSel0']+$uniqueResults[$i]['spendCntSel1']+$uniqueResults[$i]['spendCntSel2']),0).'</B>) '; 
	echo  'Κατακυρώσεις: ';
		$sumAwardSel=
                $this->fromTextToNumber($uniqueResults[$i]['awardSel0'])
		+ $this->fromTextToNumber($uniqueResults[$i]['awardSel1'])
		+ $this->fromTextToNumber($uniqueResults[$i]['awardSel2'])  ; 
	echo  '<B> '.  $this->fromNumberToText($sumAwardSel,'€').'</B>';
	echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>) '; 	
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']<br>';	
	
	//echo  substr($nameLink,strpos($nameLink, "?="));
	//$link2=fromHidden($hidden,(substr($nameLink,strpos($nameLink, "?="))));
	$link2=$uniqueResults[$i]['linkHKB'];
	if ((isset($link2)) && ($link2 !== ' ')){
	//echo "<a href='".$link2."'target='_blank' <FONT COLOR='#006621' >$link2</FONT></a> </br>";	
	//echo "<a href='".$link2."'target='_blank'  > <font  <B>Στο ΚΗΜΔΗΣ</B></font> </a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> '; 
	//echo '<sup><font size="2">ΦΟΡΕΑΣ: </font></sup>';
	//echo '<B> ';
	echo ' <font color="#FFA500" size="1">ΦΟΡΕΑΣ&nbsp </font> '; 
	//echo ' <font color="#006621" size="1">ΦΟΡΕΑΣ&nbsp </font> '; 
	//echo '</B> ';
	echo  'Συμβάσεις: ';
			$sumContracts=  $this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevHKB']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurHKB'])  ;
		echo '<B>'.  $this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoHKB']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevHKB']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurHKB'])  ;
		echo '<B>'.  $this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoHKB']),0).'</B>) ';
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateHKB'].']<br>';	
	}
	$link3=$uniqueResults[$i]['linkHKS'];
	if ((isset($link3)) && ($link3 !== ' ')){
	//$link3=fromHidden($hidden,(substr($nameLink,strpos($nameLink, "?="))));	
	//echo "<a href='".$link3."'target='_blank' <FONT COLOR='#006621' >$link3</FONT></a> </br>";
	//echo 'Στο ';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> '; 
	//echo "<a href='".$link3."'target='_blank' > <B>Στο ΚΗΜΔΗΣ</B></a> </br>";
	//echo '<B> ';
	echo ' <font color="#FFA500" size="1">ΑΝΑΔΟΧΟΣ&nbsp </font> '; 
	//echo ' <font color="#006621" size="1">ΑΝΑΔΟΧΟΣ&nbsp </font> '; 
	//echo '</B> ';
	//echo  '<B>ΚΗΜΔΗΣ<sup><font size="1">ΑΝΑΔΟΧΟΣ</font></sup> :  </B>'; 
	$sumContracts=  $this->fromTextToNumber($uniqueResults[$i]['contractAmountPrevHKS']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCurHKS'])  ;	
	echo  'Συμβάσεις: ';
		echo '<B>'.  $this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNoHKS']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=  $this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrevHKS']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCurHKS'])  ;
		echo '<B>'.  $this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNoHKS']),0).'</B>) ';
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdateHKS'].']<br>';
	}
	
	//echo  '<B>ΚΗΜΔΗΣ<sup><font size="1">ΑΝΑΔΟΧΟΣ</font></sup> :  </B><br>'; 
	
	echo "</td>";
} 
else if (strpos($link,'diaugeiakhmdhs') !== false) { //και Διαυγεια και κημδης 998154476
    echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";	
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";
	//echo '<B>'.$name.'</B><br>';
	//echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	//echo  '<B>'.(getSource($link,'d')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; //DIAVGEIA
	
		if ($uniqueResults[$i]['dk_flag']=='d') { //αν δηλαδή η τρέχουσα γραμμή είναι όντως απο διαύγεια
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ - ΚΗΜΔΗΣ</B></a> </br>";
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> '; 
		//echo '<B>';
	    echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
        //echo '</B>';		
	    echo  'Οριστικοποίηση Πληρωμών: ';
			$sumSpend=$this->fromTextToNumber($uniqueResults[$i]['spend0']) + $this->fromTextToNumber($uniqueResults[$i]['spend1']) + $this->fromTextToNumber($uniqueResults[$i]['spend2'])  ;
        echo '<B> '.$this->fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0']+$uniqueResults[$i]['spendCnt1']+$uniqueResults[$i]['spendCnt2']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
			$sumAward=$this->fromTextToNumber($uniqueResults[$i]['award0']) + $this->fromTextToNumber($uniqueResults[$i]['award1']) + $this->fromTextToNumber($uniqueResults[$i]['award2'])  ;
		echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>) '; 	
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']<br>';	
		}
		
		else{ //η τρέχουσα γραμμή είναι απο κημδης
		//echo "<a href='".$nameLink."'target='_blank'  > <font  <B>Στο ΚΗΜΔΗΣ</B></font> </a> </br>";
		//echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
		//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> '; 
		//echo '<B>';
		echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
		//echo '</B>';
		echo  'Οριστικοποίηση Πληρωμών: ';
			$sumSpend=  $this->fromTextToNumber($uniqueResults[$i]['spend0_2']) + $this->fromTextToNumber($uniqueResults[$i]['spend1_2']) + $this->fromTextToNumber($uniqueResults[$i]['spend2_2'])  ;
		echo '<B> '.  $this->fromNumberToText($sumSpend,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0_2']+$uniqueResults[$i]['spendCnt1_2']+$uniqueResults[$i]['spendCnt2_2']),0).'</B>) '; 
		echo  'Κατακυρώσεις: ';
		$sumAward=  $this->fromTextToNumber($uniqueResults[$i]['award0_2']) + $this->fromTextToNumber($uniqueResults[$i]['award1_2']) + $this->fromTextToNumber($uniqueResults[$i]['award2_2'])  ;
		echo  '<B> '.fromNumberToText($sumAward,'€').'</B>';
		echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0_2']+$uniqueResults[$i]['awardCnt1_2']+$uniqueResults[$i]['awardCnt2_2']),0).'</B>) '; 	
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate_2'].']<br>';
		}
		
		
	//echo  '<B>'.(getSource($link,'k')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; //KHMDHS
	    // echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
		echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> '; 
	    //echo '<B>';
	    echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
		//echo '</B>';	
	    if ($uniqueResults[$i]['dk_flag']=='k') { //αν δηλαδή η τρέχουσα γραμμή είναι όντως απο κημδης
		echo  'Συμβάσεις: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmountPrev']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCur'])  ;
		echo '<B>'.$this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNo']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=$this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrev']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCur'])  ;
		echo '<B>'.$this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNo']),0).'</B>) ';		
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
		}
		else //η τρέχουσα γραμμή είναι  απο διαύγεια
		{
		echo  'Συμβάσεις: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmountPrev_2']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCur_2'])  ;
		echo '<B>'.$this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNo_2']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=$this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrev_2']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCur_2'])  ;
		echo '<B>'.$this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNo_2']),0).'</B>) ';	
		echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate_2'].']';	
	    echo "</td>";
		}
 }	
else if (strpos($link,'/australia/') !== false) { //australia
echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['city']); 
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['locality']); 
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['countryName']); 
	echo ' ';
	echo 'ABN '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΑΥΣΤΡΑΛΙΑ</font></br> '; 
	echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
	echo  'Συμβάσεις: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmount0']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmount1'])  + $this->fromTextToNumber($uniqueResults[$i]['contractAmount2'])    ;
	echo '<B>'.$this->fromNumberToText($sumContracts,'$').'</B>';
	        $counterContracts=$uniqueResults[$i]['contractCounter0'] + $uniqueResults[$i]['contractCounter1'] + $uniqueResults[$i]['contractCounter2'] ;
	echo  ' (<B>'.round($counterContracts,0).'</B>) ';		
	echo  ' &nbsp [Έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
}
else if (strpos($link,'/london/') !== false) { //Λονδίνο
echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
    echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'V.A.T. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo  '<B>'.($this->getSource($link,'all')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	if (strpos($link,'buyer')  !== false)
	echo  'Συμβάσεις: ';
	else 
	echo  'Πληρωμές: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmount0']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmount1'])  + fromTextToNumber($uniqueResults[$i]['contractAmount2']) + fromTextToNumber($uniqueResults[$i]['contractAmount3'])   ;
	echo '<B>'.$this->fromNumberToText($sumContracts,'£').'</B>';
	        $counterContracts=$uniqueResults[$i]['contractCounter0'] + $uniqueResults[$i]['contractCounter1'] + $uniqueResults[$i]['contractCounter2'] + $uniqueResults[$i]['contractCounter3'];
	echo  ' (<B>'.round($counterContracts,0).'</B>) ';		
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
}
else if (strpos($link,'/eu/') !== false) { //ευρώπη
echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
    //echo $name;
	echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
    echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'V.A.T. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo  '<B>'.($this->getSource($link,'all')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	echo  'Συμβάσεις: ';	
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmount0']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmount1'])  + $this->fromTextToNumber($uniqueResults[$i]['contractAmount2'])   ;
	echo '<B>'.$this->fromNumberToText($sumContracts,'€').'</B>';
	        $counterContracts=$uniqueResults[$i]['contractCounter0'] + $uniqueResults[$i]['contractCounter1'] + $uniqueResults[$i]['contractCounter2'] ;
	echo  ' (<B>'.round($counterContracts,0).'</B>) ';		
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
}
else if (strpos($link,'/newyork/') !== false) { //Νέα Υόρκη-πόλη
echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
    echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'V.A.T. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo  '<B>'.($this->getSource($link,'all')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	echo  'Συμβάσεις: ';	
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmount0']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmount1'])  + $this->fromTextToNumber($uniqueResults[$i]['contractAmount2'])   ;
	echo '<B>'.$this->fromNumberToText($sumContracts,'$').'</B>';
	        $counterContracts=$uniqueResults[$i]['contractCounter0'] + $uniqueResults[$i]['contractCounter1'] + $uniqueResults[$i]['contractCounter2'] ;
	echo  ' (<B>'.round($counterContracts,0).'</B>) ';		
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
}
else if (strpos($link,'/newyorkstate/') !== false) { //Νέα Υόρκη-πόλιτεία
echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
    echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'V.A.T. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo  '<B>'.($this->getSource($link,'all')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	echo  'Συμβάσεις: ';	
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmount0']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmount1'])  + fromTextToNumber($uniqueResults[$i]['contractAmount2'])   ;
	echo '<B>'.$this->fromNumberToText($sumContracts,'$').'</B>';
	        $counterContracts=$uniqueResults[$i]['contractCounter0'] + $uniqueResults[$i]['contractCounter1'] + $uniqueResults[$i]['contractCounter2'] ;
	echo  ' (<B>'.round($counterContracts,0).'</B>) ';		
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
}
else if ((strpos($link,'product') !== false) && (strpos($link,'eprices') !== false)) { //φασόλια
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	//echo '<B>'.$psName.'</B><br>';
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$psName</a> </br>";	
	//echo '<B>';
	//echo "<a href='".$nameLink."'target='_blank' >Στο ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ</a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.75em">ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ-Προϊόν</font></br> '; 
	//echo '</B>';
	//echo '<B>';
	//echo ' <font color="#FFA500" size="1">ΠΡΟΙΟΝ</font></br> '; 
	//echo '</B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Μέση 2015&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['average'];	
	echo '</B>';
	echo '&nbsp';
	echo '<font color="#FFA500" style="font-size: 0.80em">Διαφορά Τιμής 2015&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['variationPrice'];	
	echo '</B>';
	echo '</br>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Χαμηλότερη τιμή 2015&nbsp</font> ';
	echo '<B>';	
	echo $uniqueResults[$i]['minPrice'].'/'.$uniqueResults[$i]['unitOfMeasurement'];	
	echo '</B>';
	echo '&nbsp';
		$locMin=$uniqueResults[$i]['locMin'];
	echo "<FONT size='2'>$locMin</FONT>"; 	
	echo '</br>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Υψηλότερη τιμή 2015&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['maxPrice'].'/'.$uniqueResults[$i]['unitOfMeasurement'];
	echo '</B>';
	echo '&nbsp';
		$locMax=$uniqueResults[$i]['locMax'];
	echo "<FONT size='2'>$locMax</FONT>"; 	
	echo '</br>'; 
	echo  '[';
	echo '<font  style="font-size: 0.80em">Τελευταία ενημέρωση&nbsp</font> ';
	echo  $uniqueResults[$i]['lastUpdate'];	
	echo  ']';
	echo "</td>";
    
	
	echo "</td>";
}
else if ((strpos($link,'product') !== false) && (strpos($link,'kath') !== false)) { //Αγγουράκια
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	//echo '<B>'.mb_strtoupper($psName, "UTF-8").'</B><br>';
	//$psName=mb_strtoupper($psName, "UTF-8");
	$psName=mb_convert_case($psName, MB_CASE_UPPER, "UTF-8");
	$psName=str_replace("","",$psName); //function for accent
	$psName=  $this->Unaccent($psName);
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$psName</a> </br>";	
	//echo '<B>';
	//echo "<a href='".$nameLink."'target='_blank' >Στην ΚΕΝΤΡΙΚΗ ΑΓΟΡΑ ΘΕΣ/ΝΙΚΗΣ</a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.75em">ΚΕΝΤΡΙΚΗ ΑΓΟΡΑ ΘΕΣ/ΝΙΚΗΣ-Προϊόν</font></br> '; 
	//echo '</B>';
	//echo '<B>';
	//echo ' <font color="#FFA500" size="1">ΠΡΟΙΟΝ</font></br> '; 
	//echo '</B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Επικρατέστερη τιμή&nbsp</font> ';
	echo '&nbsp';
	echo '<B>';
	echo $uniqueResults[$i]['dominantPriceDetails'].' €/'.$uniqueResults[$i]['unitOfMeasurement'];	
	echo '</B>';
	echo '&nbsp';
	echo '<font color="#FFA500" style="font-size: 0.80em">Επικρατέστερη εβδομάδας&nbsp</font> ';	
	echo '&nbsp';
	echo '<B>';
	echo $uniqueResults[$i]['weekDominantPriceDetails'].' €/'.$uniqueResults[$i]['unitOfMeasurement'];	
	echo '</B>';
	echo '</br>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Επικρατέστερη έτους&nbsp</font> ';	
	echo '&nbsp';
	echo '<B>';	
	echo $uniqueResults[$i]['yearDominantPriceDetails'].' €/'.$uniqueResults[$i]['unitOfMeasurement'];		
	echo '</B>';
	echo '&nbsp';
	echo '<font color="#FFA500" style="font-size: 0.80em">Ποσότητα προς διάθεση&nbsp</font> ';	
	echo '&nbsp';
	echo '<B>';	
	echo $uniqueResults[$i]['quantityDetails'].'&nbspκιλά';
	echo '</br>';
	echo '</B>';
	echo  '[';
	echo '<font  style="font-size: 0.80em">Τελευταία ενημέρωση&nbsp</font> ';
	echo  $uniqueResults[$i]['lastUpdate'];	
	echo  ']';
	echo "</td>"; 
	

}
else if ((strpos($link,'shop') !== false) && (strpos($link,'eprices')) !== false){ //ΣΚΛΑΒΕΝΙΤΗΣ ΒΑΡΗΣ
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	//echo '<B>'.$name.'</B><br>';
	//echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	//echo '<B>'.$psName.'</B><br>';
	$psName=mb_convert_case($psName, MB_CASE_UPPER, "UTF-8");
	$psName=str_replace("","",$psName); //function for accent
	$psName=  $this->Unaccent($psName);
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$psName</a> </br>";	
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ-Σημείο Πώλησης</font></br> '; 
	//echo '<B>';
	//echo "<a href='".$nameLink."'target='_blank' >Στο ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ</a> </br>";
	//echo '</B>';
	//echo '<B>';
	//echo ' <font color="#FFA500" size="1">ΣΗΜΕΙΟ ΠΩΛΗΣΗΣ</font></br> '; 
	//echo '</B>';
    //echo 'Πλήθος Ειδών ';
	echo '<font color="#FFA500" style="font-size: 0.80em">Προϊόντα&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['countOfProducts'];	
	echo '</B>';
	echo '&nbsp';
	echo '<font color="#FFA500" style="font-size: 0.80em">Κατηγορίες&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['countOfCategories'];	
	echo '</B>';
	echo '</br>'; 
	echo '<font color="#FFA500" style="font-size: 0.80em">Υψηλότερη τιμή&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['maxPrice'].'/'.$uniqueResults[$i]['unitOfMeasurementMax'];	
	echo '</B>';
    echo '&nbsp';		
		$maxProdName=$uniqueResults[$i]['maxProdName'];
	echo "<FONT size='2'>$maxProdName</FONT>";	
	echo '</br>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Χαμηλότερη τιμή&nbsp</font> ';
	echo '<B>';
	echo $uniqueResults[$i]['minPrice'].'/'.$uniqueResults[$i]['unitOfMeasurementMin'];		
	echo '</B>';
	echo '&nbsp';	
		$minProdName=$uniqueResults[$i]['minProdName'];
	echo "<FONT size='2'>$minProdName</FONT>"; 	
	echo '</br>'; 
	echo  '[';
	echo '<font  style="font-size: 0.80em">Τελευταία ενημέρωση&nbsp</font> ';
	echo  $uniqueResults[$i]['lastUpdate'];	
	echo  ']';
	echo "</td>";
}
else if (strpos($link,'cpv') !== false)   { 
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
	//echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
	//echo '<B>'.$name.'</B><br>';
	//echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	$name=mb_convert_case($name, MB_CASE_UPPER, "UTF-8");
	$name=str_replace("","",$name); //function for accent
	$name=  $this->Unaccent($name);
	//$name=iconv("utf-8","ascii//TRANSLIT",$name);
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['vat']."</br>");	
	echo '</I>';
	//echo  '<B>'.(getSource($link,'d')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	//echo "<a href='".$nameLink."'target='_blank'  > <B>Στη ΔΙΑΥΓΕΙΑ</B></a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΑΤΗΓΟΡΙΑ</font> '; 
	//echo '&nbsp';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΑΠΑΝΗΣ</font> ';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">-</font> ';
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">'.$property.'</font></br> '; 
	echo 'Συνολικά: ';	
	if ($uniqueResults[$i]['cpvSumofAmounts']!=='-'){
	echo '<B>';
	echo '€';
	echo $uniqueResults[$i]['cpvSumofAmounts']; 
    echo '</B>';	
	}
	else
    echo '-';
	echo ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
	echo "</td>";
} 
else
if  	((strpos($link,'shop') !== false) && (strpos($link,'fuel')) !== false){	
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";	
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";
    echo '<I>';
	echo hide_not_avail($uniqueResults[$i]['address']."</br>");	
	echo '</I>';		
	echo ' <font class="dataset" color="#006621" style="font-size: 0.75em">ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ ΥΓΡΩΝ ΚΑΥΣΙΜΩΝ-Σημείο Πώλησης</font></br> '; 
    echo '<B>';	
	//echo 'Μάρκα:'.hide_not_avail($uniqueResults[$i]['brand']."</br>");
    $brand=$uniqueResults[$i]['brand'];	
	echo "<font color='#FFA500' style='font-size: 0.80em'>$brand</font> ";
	echo '</B>';
	echo '</br>'; 
	echo  '[';
	echo '<font  style="font-size: 0.80em">Τελευταία ενημέρωση&nbsp</font> ';
	echo  $uniqueResults[$i]['lastUpdate'];	
	echo  ']';
	echo "</td>";
}
else
if  	((strpos($link,'product') !== false) && (strpos($link,'fuel') !== false)) {
	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	//echo '<B>'.$name.'</B><br>';
	//$name=mb_strtoupper($name, "UTF-8");
	$name=mb_convert_case($name, MB_CASE_UPPER, "UTF-8");
	$name=str_replace("","",$name); //function for accent
	$name=  $this->Unaccent($name);
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
	//echo "<a href='".$nameLink."'target='_blank' >Στο ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ</a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.75em">ΠΑΡΑΤΗΡΗΤΗΡΙΟ ΤΙΜΩΝ ΥΓΡΩΝ ΚΑΥΣΙΜΩΝ-Προϊόν</font></br> '; 
	//echo ' <font color="#FFA500" size="1">ΠΡΟΙΟΝ</font></br> '; 
	echo '<B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Μέση 2015&nbsp</font> ';
	echo '</B>';    
	echo '<B>';
	echo $uniqueResults[$i]['averagePreviousYear'];	
	echo '</B>';
	echo '&nbsp';
	echo '<B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Μέση 2016&nbsp</font> ';
	echo '</B>';	
	echo '<B>';
	echo $uniqueResults[$i]['average'];	
	echo '</B>';
	echo '&nbsp';
	echo '<B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Διαφορά Τιμής 2016&nbsp</font> ';
	echo '</B>';		
	echo '<B>';
	echo $uniqueResults[$i]['variationPrice'];	
	echo '</B>';
	echo '</br>';
	echo '<B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Χαμηλότερη τιμή 2016&nbsp</font> ';
	echo '</B>';	
	echo '<B>';	
	echo $uniqueResults[$i]['minPrice'];	
	echo '</B>';
	echo '&nbsp';
		$locMin=$uniqueResults[$i]['locMin'];
	echo "<FONT size='2'>$locMin</FONT>"; 	
	echo '</br>';
	echo '<B>';
	echo '<font color="#FFA500" style="font-size: 0.80em">Υψηλότερη τιμή 2016&nbsp</font> ';
	echo '</B>';		
	echo '<B>';
	echo $uniqueResults[$i]['maxPrice'];
	echo '</B>';
	echo '&nbsp';
		$locMax=$uniqueResults[$i]['locMax'];
	echo "<FONT size='2'>$locMax</FONT>"; 	
	echo '</br>'; 
	echo  '[';
	echo '<font  style="font-size: 0.80em">Τελευταία ενημέρωση&nbsp</font> ';
	echo  $uniqueResults[$i]['lastUpdate'];	
	echo  ']';
	echo "</td>";
    
	
	echo "</td>";
}
else { //κημδης και τα αλλα 023199666

	echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">";
	//echo "<a href='".$nameLink."'target='_blank' >$name</a> </br>";
	//echo '<B>'.$name.'</B><br>';
	echo "<a class='nameLink' href='".$nameLink."'target='_blank' >$name</a> </br>";	
    //echo "<FONT COLOR='#006621 '>$link</FONT></br>"; 
	echo '<I>';
	echo $this->hide_not_avail($uniqueResults[$i]['address']);
	echo ' ';
	echo $this->hide_not_avail($uniqueResults[$i]['pc']);
	echo ' ';
	echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
	echo ' ';
	echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
	echo '</I>';
	//echo "<a href='".$nameLink."'target='_blank'  > <B>Στo ΚΗΜΔΗΣ</B></a> </br>";
	echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΚΗΜΔΗΣ</font></br> '; 
	//echo '<B>';
	echo ' <font color="#FFA500" size="1">'.$property.'</font> '; 
	//echo '<B>';
	//echo  '<B>'.(getSource($link,'all')).'<sup><font size="1">'.$property.'</font></sup> :  </B>'; 
	echo  'Συμβάσεις: ';
			$sumContracts=$this->fromTextToNumber($uniqueResults[$i]['contractAmountPrev']) + $this->fromTextToNumber($uniqueResults[$i]['contractAmountCur'])  ;
		echo '<B>'.$this->fromNumberToText($sumContracts,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['contractItemsNo']),0).'</B>) ';
		echo  'Πληρωμές: ';
			$sumPayments=$this->fromTextToNumber($uniqueResults[$i]['paymentAmountPrev']) + $this->fromTextToNumber($uniqueResults[$i]['paymentAmountCur'])  ;
		echo '<B>'.$this->fromNumberToText($sumPayments,'€').'</B>';
		echo  ' (<B>'.round(($uniqueResults[$i]['paymentItemsNo']),0).'</B>) ';
		
	echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
    echo "</td>";
}  
 $uniqueResults[$i]['score'] = $uniqueResults[$i]['score'] + $uniqueResults[$i]['relative1'] + $uniqueResults[$i]['relative2'] + $uniqueResults[$i]['relative3'] + $uniqueResults[$i]['relative4']  ;
	          
				
	
 
 /*echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:200px;\">";
 if(empty($uniqueResults[$i]['vat']) ||  ((strpos($link,'newyorkstate') !== false) &&  (strpos($link,'seller') !== false))  ) {
 echo "-";
 }
 else
 echo $uniqueResults[$i]['vat']; //HIDDEN
 echo "</td>";
 
 echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:200px;\">";
 //echo getSource($link); 
 echo "</td>";
  */
 
 
 echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:80px;\">";
 

 echo $uniqueResults[$i]['score']; //hidden

 echo "</td>";
/* echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:80px;\">";
 echo 'score='.$uniqueResults[$i]['score']	.'<br>';
 echo 'r1='.$uniqueResults[$i]['relative1']	.'<br>';
 echo 'r2='.$uniqueResults[$i]['relative2']	.'<br>';
 echo 'r3='.$uniqueResults[$i]['relative3']	.'<br>';
 echo 'r4='.$uniqueResults[$i]['relative4']	.'<br>';
 //$uniqueResults[$i]['score'] = $uniqueResults[$i]['score'] + $uniqueResults[$i]['relative1'] + ($uniqueResults[$i]['relative2'] - $uniqueResults[$i]['relative1'] );

 echo "</td>"; */

 
 
 echo "</tr>"; 

}
 
 $i++;
 
 }
 echo "</tbody>";
 echo"</table>";


}
    
    function unique_multidim_array($array, $key){
        $temp_array = [[]]; //empty array
        $i = 0;
        $key_array = [[]]; //empty array           

        foreach($array as $val){	

            if 	(!in_array($val[$key],$key_array))   { 
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
                $i++;
            }
                    
            else { 
                
            }
                    

        }
        return $temp_array;

    }
    
    function hideDuplicate($double,$link){
        $remove=0;
        foreach ($double as $key => $val) {
            if ($val['link'] == $link)
                $remove=1;
            }
        return $remove;
    }
    
    function convertDate($date){
        if (substr($date,0,3)== 201){
             $revDate= date("d-m-Y", strtotime($date));
        }
        //$revDate='wrong'.$date;
       
        else {
            $revDate=$date;
        }
            
        return $revDate;

    }
    function hide_not_avail($field){
	if (($field=='Μη Διαθέσιμο') || ($field=='Ο ΑΦΜ δεν έχει καταχωρηθεί') ||($field=='-')){
	$field='';
	}
	return $field;
}
    function hide_not_avail_space($field){
	if (($field=='Μη Διαθέσιμο') || ($field=='') || ($field=='Ο ΑΦΜ δεν έχει καταχωρηθεί') ||($field=='-')){
	$field=' ';
	}
	else {
	$field=($field.' &nbsp');
	}
	
	return $field;
        
        
    }
    function getSource($link,$dk){
        if ($dk=='d')
        $source="ΔΙΑΥΓΕΙΑ";
        else
         if ($dk=='k')
        $source="ΚΗΜΔΗΣ";
        else if ($dk=='all' ) {
        if  ((strpos($link,'khmdhs') !== false) && (strpos($link,'diaugeiakhmdhs') == false))
        {
        $source="ΚΗΜΔΗΣ";
        }
        else
        if  ((strpos($link,'diaugeia') !== false) && (strpos($link,'diaugeiakhmdhs') == false))
        {
        $source="ΔΙΑΥΓΕΙΑ";
        }
        else
        if  ((strpos($link,'australia') !== false) &&  (strpos($link,'buyer') !== false)) 
        {
        $source="ΑΥΣΤΡΑΛΙΑ";
        }
        else
        if  (strpos($link,'diaugeiakhmdhs') !== false) 
        {
        $source="ΔΙΑΥΓΕΙΑ / ΚΗΜΔΗΣ ";
        }
        else
        if  (strpos($link,'australia') !== false)
        {
        $source="ΑΥΣΤΡΑΛΙΑ ";
        }
        else
        if  ((strpos($link,'hybrid') !== false) ) 
        {
        $source="ΔΙΑΥΓΕΙΑ";
        }
        else
        if  ((strpos($link,'newyork') !== false) &&  (strpos($link,'newyorkstate') == false)) 
        {
        $source="ΝΕΑ ΥΟΡΚΗ(Πόλη) ";
        }
        else
        if  (strpos($link,'newyorkstate') !== false)  
        {
        $source="ΝΕΑ ΥΟΡΚΗ(Πολιτεία)";
        }

        if  (strpos($link,'london') !== false) 
        {
        $source="ΛΟΝΔΙΝΟ";
        }
        if  (strpos($link,'eu') !== false)  
        {
        $source="ΕΥΡΩΠΗ FTS ";
        }
        }
        //echo  $source;
        return $source;
        }
        
        function fromTextToNumber($text) {
        $numbered=0;
        if ((strpos($text,'M') !== false) || (strpos($text,'Μ') !== false)) {
        $numbered=str_replace("€", "",$text);
        $numbered=str_replace("$", "",$numbered);
        $numbered=str_replace("£", "",$numbered);
        $numbered=str_replace("M", "",$numbered);
        $numbered*=1000000;
        }
        else 
        if ((strpos($text,'K') !== false) || (strpos($text,'Κ') !== false)) {
        $numbered=str_replace("€", "",$text);
        $numbered=str_replace("$", "",$numbered);
        $numbered=str_replace("£", "",$numbered);
        $numbered=str_replace("K", "",$numbered);
        $numbered*=1000;
        }
        else 
        if ((strpos($text,'B') !== false) || (strpos($text,'Β') !== false)) {
        $numbered=str_replace("€", "",$text);
        $numbered=str_replace("$", "",$text);
        $numbered=str_replace("£", "",$numbered);
        $numbered=str_replace("B", "",$numbered);
        $numbered*=1000000000;
        }
        else {
        $numbered*=1;
        }

        return $numbered;
    }

function fromNumberToText($number,$currency) {
$texted=$currency.'0.0K'; //€0.0K
$digits=strlen($number);
	if (($digits == 1) || (($digits) == 2)){
	$texted=$currency.'0.0K';
	}
	else
	if ($digits == 3) { //e.g. 860=0.8K
	$dividor=1000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'K';
	}
	else
	if ($digits == 4) { //e.g 8600->8.6K
	$dividor=1000;
	//$texted='€'.round($number/($dividor),1).'K';
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'K';
	}
	else
	if ($digits == 5) { //e.g 86000->86K
	$dividor=1000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'K';
	}
	else
	if ($digits == 6) { //e.g 860000->0.8M (kanonika 0.9)
	$dividor=1000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'M';
	}
	else
	if ($digits == 7) { //e.g 8.600.000->8.6K  
	$dividor=1000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'M';
	}
	else
	if ($digits == 8) { //e.g 80.600.000->80.6M  
	$dividor=1000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'M';
	}
	else
	if ($digits == 9) { //e.g 800.600.000->0.8B  //ok
	$dividor=1000000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'B';
	}
	else
	if ($digits == 10) { //e.g 8.000.600.000->8B  //ok
	$dividor=1000000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'B';
	}
	else
	if ($digits == 11) { //e.g 80.000.600.000->80B  //ok
	$dividor=1000000000;
	$texted=$currency.number_format(round($number/($dividor),1), 1, '.', '').'B';
	}
	else {
	$texted=$currency.'0.0K'; //test only
	}

	return $texted;
}

    
}
