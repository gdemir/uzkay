<?php
include 'pdf.php';
include 'init.php';

F3::set('template', 'sorguok');

// FIXME production kodda derin değişiklikler yapmak istemiyorum.
// Bu yüzden SESSION.tc yerine SESSION.sorgutc şeklinde kaydet
// eyleminin atadığı değerlerden farklı değerler atandı.  Arada
// bir state kaçırırsak sızma olmasın.
$tc = F3::get('SESSION.sorgutc');
$kizliksoyad = F3::get('SESSION.sorgukizliksoyad');
if (!empty($kizliksoyad) && preg_match('/^\d{11}$/', $tc)) {
	$kul = new Axon('kul');
	$kul->load("tc=$tc");

	if (!$kul->dry() && streq_turkish($kul->kizliksoyad, $kizliksoyad)) {
		pdf($kul);
	}
	else {
		F3::set('error', "Böyle bir kayıt bulunamadı.");
		F3::call('sorgu');
	}
}
else {
	echo "hatali istek";
}

?>
