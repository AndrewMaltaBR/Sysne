<?php
	$acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$langs = array();
	foreach( explode(',', $acceptLanguage) as $lang) {
	    $lang = explode(';q=', $lang);
	    $langs[$lang[0]] = count($lang)>1?floatval($lang[1]):1;
	}
	arsort($langs);
	
	$ourLanguages = array('pt-BR'=>'pt','pt'=>'pt');
	$choice = 'en'; //Caso nenhuma outra sirva
	foreach($langs as $lang=>$q) {
	   if(in_array($lang,array_flip($ourLanguages))) {
	      $choice=$ourLanguages[$lang];
	      break;
	   }
	}

	session_start();
	$page = "";
	if(!isset($_SESSION["session"]))
		$page = "dashboard";

	header("Location: $choice/$page");
?>