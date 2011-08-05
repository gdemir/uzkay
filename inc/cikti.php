<?php
include 'pdf.php';


$tc = F3::get('SESSION.tc');
if (preg_match('/^\d{11}$/', $tc)) {
	$kul = new Axon('kul');
	$kul->load("tc=$tc");

	if (!$kul->dry()) {
		pdf($kul);
	}
	else {
		F3::set('error', "$tc nolu bir kayıt yok");
	}
}
else {
	echo "hatali istek";
}
?>
