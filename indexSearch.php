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
class indexSearch {
   function getAll($LuceneOperand,$varKeyword,$DbPath){
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
}
