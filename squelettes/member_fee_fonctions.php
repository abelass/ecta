<?php

function shasign($id_auteur,$amount) {
	$ogone_sha_pwd = "=:;,nbvcxwqazertyuiop";
	$currency = "EUR";
	$PSPID = "ecta1";
	$order_ID = "FEE_".$id_auteur."_".date('ymd-Hi');
	return strtoupper(sha1($order_ID.$amount.$currency.$PSPID.$ogone_sha_pwd));
}

?>
