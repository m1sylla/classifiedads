<?php

/*
*	Insert space in string
*/
if (!function_exists('inserer_espace_string')) {
    function inserer_espace_string($str, $step, $reverse = false)
    {
        if ($reverse)
        return strrev(chunk_split(strrev($str), $step, ' '));

        return chunk_split($str, $step, ' ');
    }
}

/* Mobile device type detection  */
if( !function_exists('is_mobile_user_agent_ios') ){
	function is_mobile_user_agent_ios(){

        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

        if ($iPod || $iPhone || $iPad) {
            return true;
        }
		
		return false;
	}
}

/* Mobile device detection  */
if( !function_exists('is_agent_mobile') ){
	function is_agent_mobile(){


	}
}