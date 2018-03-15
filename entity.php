<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entity
 *
 * @author dimitris negkas
 */
class entity {
   var $name;
   var $vat;
   var $alternate_names;
   
   function set_name($name){
       $this->name = $name;
   }
   function set_vat($vat){
       $this->vat = $vat;
   }
   function set_alternate_names($alternate_names){
       $this->alternate_names = $alternate_names;
   }
   
   function get_name() {
       return $this->name;
   }
   function get_vat() {
       return $this->vat;
   }
   function get_alternate_names() {
       return $this->alternate_names;
   }
}
