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
        $Actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($Actual_link,'/en/') !== false) {
            $Lang = 'en/';
        }
        else {
             if (strpos($Actual_link,'/el/') !== false) {
                $Lang= 'el/';
             }
        }
    }
}
