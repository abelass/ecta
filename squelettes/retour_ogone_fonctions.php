<?php

function traite_retour_ogone($fee_year, $date) {
	
	$key = "Le ReT0ur est T0J0rs simple !"; // SHA1-out du compte Ogone
	
	$l_status = array(
		0 => "incomplete or invalid",
		1 => "Cancelled by client",
		2 => "Authorization refused",
		4 => "Order stored",
		41 => "Waiting client payment",
		5 => "Authorized",
		51 => "Authorization waiting",
		52 => "Authorization not known",
		55 => "Stand-by",
		59 => "Authoriz. to get manually",
		6 => "Authorized and cancelled",
		61 => "Author. deletion waiting",
		62 => "Author. deletion uncertain",
		63 => "Author. deletion refused",
		64 => "Authorized and cancelled",
		7 => "Payment deleted",
		71 => "Payment deletion pending",
		72 => "Payment deletion uncertain",
		73 => "Payment deletion refused",
		74 => "Payment deleted",
		75 => "Deletion processed by merchant",
		8 => "Refund",
		81 => "Refund pending",
		82 => "Refund uncertain",
		83 => "Refund refused",
		84 => "Payment declined by the acquirer",
		85 => "Refund processed by merchant",
		9 => "Payment requested",
		91 => "Payment processing",
		92 => "Payment uncertain",
		93 => "Payment refused",
		94 => "Refund declined by the acquirer",
		95 => "Payment processed by merchant",
		99 => "Being processed");

	$param = explode('_',$_REQUEST['orderID']); //FEE_id_auteur_YYYYMMJJ-HHII

	$str = $_REQUEST['orderID'].$_REQUEST['currency'].$_REQUEST['amount'].$_REQUEST['PM'].$_REQUEST['ACCEPTANCE'].$_REQUEST['STATUS'].$_REQUEST['CARDNO'].$_REQUEST['PAYID'].$_REQUEST['NCERROR'].$_REQUEST['BRAND'];

	if (strtolower($_REQUEST['SHASIGN']) == sha1($str.$key) && $_REQUEST['STATUS'] == 9) {
		// On est en mode direct, plus en mode avec autorisation
		spip_query("update ecta_members set 
								membership_year='$fee_year',
								payment_error = '', 
								method_of_payment = '".addslashes($_REQUEST['PM'])."',
								date_of_payment = '$date',
								reference = '".addslashes($_REQUEST['PAYID'])."'
								WHERE id_auteur='".addslashes($param[1])."'","ectamembersdev");
		spip_log("update ecta_members set 
								membership_year='$fee_year',
								payment_error = '', 
								method_of_payment = '".addslashes($_REQUEST['PM'])."',
								date_of_payment = '$date',
								reference = '".addslashes($_REQUEST['PAYID'])."'
								WHERE id_auteur='".addslashes($param[1])."'");
	} else {
		spip_query("update ecta_members set 
								payment_error = '".$l_status[$_REQUEST['STATUS']].". ".addslashes($_REQUEST['NCERROR'])."',
								method_of_payment = '".addslashes($_REQUEST['PM'])."',
								date_of_payment = '$date',
								reference = '".addslashes($_REQUEST['PAYID'])."'
								WHERE id_auteur='".addslashes($param[1])."'","ectamembersdev");
		spip_log($_REQUEST['SHASIGN']." == ".sha1($str.$key));
		spip_log($str.$key);
		spip_log("update ecta_members set 
								payment_error = '".$l_status[$_REQUEST['STATUS']].". ".addslashes($_REQUEST['NCERROR'])."',
								method_of_payment = '".addslashes($_REQUEST['PM'])."',
								date_of_payment = '$date',
								reference = '".addslashes($_REQUEST['PAYID'])."'
								WHERE id_auteur='".addslashes($param[1])."'");
	}
	
}


?>