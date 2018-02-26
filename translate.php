<?php
$source='index.php';
$destination='index_en.php';

$path_to_file = 'C:\Users\dimitris negkas\Documents\repos\searchOPJ/'.$source;
#$file_contents = file_get_contents($path_to_file);
$file_contents = file_get_contents($path_to_file);
//$file_contents = str_replace("ΑΠΘ","APTH",$file_contents);
#file_put_contents('/var/www/linkedeconomy/searchDrupal/translate/out/'.$destination,$file_contents);
file_put_contents('C:\Users\dimitris negkas\Documents\repos\searchOPJ/'.$destination,$file_contents);

if (($handle = fopen('C:\Users\dimitris negkas\Documents\repos\searchOPJ/searchTranslation.csv', "r")) !== FALSE){
		while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
			//print_r($data);
			//echo $data[0]; 
			$file_contents = str_replace($data[0],$data[1],$file_contents);
		} //end of reading file
		
	fclose($handle);
			
	} //end of check if file exists//
	
file_put_contents('C:\Users\dimitris negkas\Documents\repos\searchOPJ/'.$destination,$file_contents);

?>