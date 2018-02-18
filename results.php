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
    function showResults(){
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
                }
            }
        }
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
}
