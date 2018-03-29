<?php
$source =['index.php','collectData.php','showResults.php'];
$destination =['index_en.php','collectData_en.php','showResults_en.php'];

foreach ($source as $key => $value) {
    $path_to_file = 'C:\Users\dimitris negkas\Documents\repos\searchOPJ/'.$value;
    $file_contents = file_get_contents($path_to_file);


if (($handle = fopen('C:\Users\dimitris negkas\Documents\repos\searchOPJ/searchTranslation.csv', "r")) !== FALSE){
		while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
			//print_r($data);
			//echo $data[0]; 
			$file_contents = str_replace($data[0],$data[1],$file_contents);
		} //end of reading file
		
	fclose($handle);
			
	} //end of check if file exists//
	
file_put_contents('C:\Users\dimitris negkas\Documents\repos\searchOPJ/'.$destination[$key],$file_contents);
}



?>