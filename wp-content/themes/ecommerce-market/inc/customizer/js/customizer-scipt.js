/**
* Custom Js for backend 
*
* @package eCommerce_Market
*/
jQuery(document).ready(function($) {
    $('#ecommerce-market-img-container li label img').click(function(){    	
        $('#ecommerce-market-img-container li').each(function(){
            $(this).find('img').removeClass ('ecommerce-market-radio-img-selected') ;
        });
        $(this).addClass ('ecommerce-market-radio-img-selected') ;
    });                    
});