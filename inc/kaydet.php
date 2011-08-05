<?php
include 'denetle.php';
// ek denetlemeler unutmayalim!
// ad ve soyad şart
foreach (array('ad', 'soyad') as $alan) {
	F3::input($alan,
		function($value) use($alan) {
			$ne = ucfirst($alan);
			if ($hata = denetle($value, array(
				'dolu'    => array(true, "$ne boş bırakılamaz"),
				'enaz'    => array(2,    "$ne çok kısa"),
				'enfazla' => array(127,  "$ne çok uzun"),
			))) { F3::set('error', $hata); return; }
			F3::set("REQUEST.$alan", ucfirst($value));
		}
	);
}
// tc numara geçerli olmalı
F3::input($alan='tc',
	function($value) use($alan) {
		$ne = "Tc No";
		if ($hata = denetle($value, array(
			'dolu'    => array(true, "$ne boş bırakılamaz"),
			'esit'    => array(11,   "$ne 11 haneli olmalıdır"),
			'tamsayi' => array(true, "$ne sadece rakam içermeli"),
			'ozel'    => array(function($value) { return ! is_tc($value); },
					"Geçerli bir $ne değil"),
		))) { F3::set('error', $hata); return; }

		$kul = new Axon('kul');
		if ($kul->found("tc=$value")) {
			F3::set('error', "$ne $value daha önceden eklendi");
			return;
		}
	}
);

// denetleme sırasında hata oluşmamışsa kayıt yapacağız
// hata olmadığını nereden anlıyoruz?  "error"a bakarak
if (! F3::exists('error')) {
	$kul = new Axon('kul');
	$kul->copyFrom('REQUEST');
	$kul->tarih = date("Y-m-d");
	$kul->saat = date("H:i");

	// artık elimizde temiz bir tc no var, resmi kaydedelim ilk kurulum sırasında bu <uploaddir> dizinini oluştur
	// php prosesi yazacağına göre izinleri doğru ayarla chgrp -R www-data <uploaddir> && chmod g+w <uploaddir>

	$tc = $kul->tc;
	F3::set('tc', $tc);

	if (! empty($tc)) {
		$resim = F3::get('uploaddir') . $kul->tc . '.jpg';
		// resimi yukleyip denetleyelim
		yukle($resim);
	}

	if (! F3::exists('error')) {
		// here we go!
		$kul->save();
		// TODO: burada bir özet verelim
		F3::set('correct', ' Ön kaydınız başarıyla yapıldı.');
		// tc no'yu oturuma gömelim ve oradan alalım
		F3::set('SESSION.tc', $tc);
		F3::clear('SESSION.user');
		F3::clear('SESSION.captcha');
		return F3::reroute('/ok');
	}
}

// hata var, dön başa ve tekrar kayıt al.
// error alanı dolu ve layout.htm'de görüntülenecek
F3::call('goster.php');
?>
