<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of showResults
 *
 * @author dimitris negkas
 */
class showResults {
    function presentResults(){
        global $Results;
        $this->saveCsvCloud($Results, '/var/log/results.csv');
        #print_r($Results);
        $source = ' ';
        $i = 0;
        $uniqueResults = $Results; //let 's see if there is need to group
        $sumResults = count($uniqueResults);
        $sumSpend = 0;
        $sumAward = 0;
        $sumContracts = 0;
        $sumPayments = 0;
        $counterContracts = 0;
        $sumAwardSel = 0;
        $sumSpendSel = 0;
        
       
        
        echo "<table id='searchResults' class='display'  ><thead><tr><th></th></th></th> </tr></thead>";  

        echo "<tbody>";
        
        while ($i < $sumResults) { 
            
            $name = $uniqueResults[$i]['name'];
            
            
            if  (isset($uniqueResults[$i]['vat'])) {        
                if  (!is_numeric($uniqueResults[$i]['vat'])) { //boost step 2
                    $uniqueResults[$i]['score'] = bcmul(0.75,$uniqueResults[$i]['score'] ,4) ;
                }
            
                    echo "<tr>";

                        //show diaugeia
                   if (!empty($uniqueResults[$i]['altNames'])) {
                       echo 'Eμφανίζεται και ως: '.$this->hide_not_avail(implode(',',$uniqueResults[$i]['altNames'])."</br>");
                   }
                   if ($uniqueResults[$i]['dataDiaugeia'] == 1){

                        echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
                        #echo 'diaugeia division '.$i.PHP_EOL;
                        echo "<a class='nameLink' href='#' target='_blank' >$name</a> </br>";	
                        echo '<I>';
                        echo $this->hide_not_avail($uniqueResults[$i]['address']);
                        echo ' ';
                        echo $this->hide_not_avail($uniqueResults[$i]['pc']);
                        echo ' ';
                        echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
                        echo ' ';
                        echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
                        echo '</I>';
                        echo ' <font class="dataset" color="#006621" style="font-size: 0.77em">ΔΙΑΥΓΕΙΑ</font></br> ';
                        echo ' <font color="#FFA500" size="1">property</font> '; 
                        echo  'Οριστικοποίηση Πληρωμών: ';
                        $sumSpend = $this->fromTextToNumber($uniqueResults[$i]['spend0']) + $this->fromTextToNumber($uniqueResults[$i]['spend1']) + $this->fromTextToNumber($uniqueResults[$i]['spend2'])  ;
                        echo '<B> '.$this->fromNumberToText($sumSpend,'€').'</B>';
                        echo ' (<B>'.round(($uniqueResults[$i]['spendCnt0']+$uniqueResults[$i]['spendCnt1']+$uniqueResults[$i]['spendCnt2']),0).'</B>) '; 
                        echo  'Κατακυρώσεις: ';
                        $sumAward = $this->fromTextToNumber($uniqueResults[$i]['award0']) + $this->fromTextToNumber($uniqueResults[$i]['award1']) + $this->fromTextToNumber($uniqueResults[$i]['award2'])  ;
                        echo  '<B> '.$this->fromNumberToText($sumAward,'€').'</B>';
                        echo ' (<B>'.round(($uniqueResults[$i]['awardCnt0']+$uniqueResults[$i]['awardCnt1']+$uniqueResults[$i]['awardCnt2']),0).'</B>) '; 
                        echo  ' &nbsp [έως '.$uniqueResults[$i]['lastUpdate'].']';	
                        echo "</td>";
                        # $uniqueResults[$i]['score'] gets boosted by sources



                   }
                    else { //no source - default
                       echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:400px;\">"; 
                        echo "<a class='nameLink' href='#' target='_blank' >$name</a> </br>";	
                        echo '<I>';
                        echo $this->hide_not_avail($uniqueResults[$i]['address']);
                        echo ' ';
                        echo $this->hide_not_avail($uniqueResults[$i]['pc']);
                        echo ' ';
                        echo $this->hide_not_avail_space($uniqueResults[$i]['city']); 
                        echo ' ';
                        echo 'Α.Φ.Μ. '.$this->hide_not_avail($uniqueResults[$i]['vat']."</br>");
                        echo '</I>';

                        echo "</td>"; 
                    } 
                    echo "<td style=\" text-align:left; border-left: 0px solid #ccc; font-size:15px; padding-right:0px;  width:80px;\">";
                    echo $uniqueResults[$i]['score']; //hidden
                    echo "</td>";

                    echo "</tr>"; 
                }
            $i++;
         }
         
        echo "</tbody>";
        echo "</table>";
            
        
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
    
    function saveCsvCloud($tableName,$fileName){
	$fp = fopen($fileName, 'w');

	foreach ($tableName as $fields) {
            fputcsv($fp, $fields,"~");		
	}

	fclose($fp);	
    }
}
