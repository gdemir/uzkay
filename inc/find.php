<?php

include 'control.php';
// ek denetlemeleri unutmayalim!
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
	}
);

F3::input($alan='kizliksoyad',
	function($value) use($alan) {
		$ne = "Kızlık Soyadı";
		if ($hata = denetle($value, array(
			'dolu'    => array(true, "$ne boş bırakılamaz"),
		))) { F3::set('error', $hata); return; }
	}
);

if (! F3::exists('error')) {
	$tc = F3::get('REQUEST.tc');
	$kizliksoyad = F3::get('REQUEST.kizliksoyad');

	$kul = new Axon('kul');
	$kul->load("tc=$tc");

	if (!$kul->dry() && streq_turkish($kul->kizliksoyad, $kizliksoyad)) {
		// tc no'yu oturuma gömelim ve oradan alalım
		F3::set('SESSION.photo',$kul->photo);
		F3::set('SESSION.tc', $tc);
		F3::set('SESSION.kizliksoyad', $kizliksoyad);
		F3::clear('SESSION.captcha');

		F3::set('SESSION.kisisel', array(
				"Tc kimlik no : " => $kul->tc,
				"Ad : " => $kul->ad,
				"Soyad : " => $kul->soyad,
				"Kızlık Soyadı : " => $kul->kizliksoyad,
				"Baba Adı : " => $kul->babaad,
				"Ana Adı : " => $kul->anaad,
				"Doğum Yeri : " => $kul->dogumil,
				"Doğum Yılı : " => $kul->dogumyil,
		));
		F3::set('SESSION.iletisim', array(
				"Cep Tel : " => $kul->ceptel,
				"Ev Tel : " => $kul->evtel,
				"Email : " => $kul->email,
				"Ev Adres : " => $kul->evadres,
				"İl :" => $kul->il,
				"İlçe : " => $kul->ilce,
				"Üniversite : " => $kul->uni,
		));
		F3::set('SESSION.is', array(
				"Kurum : " => $kul->calismakurum,
				"Birim : " => $kul->calismabirim,
				"İl : " => $kul->isil,
				"İlçe : " => $kul->isilce,
		));
		F3::set('SESSION.diger', array(
				"Ön Kayıt Tarihi : " => $kul->tarih,
		));
		return F3::reroute('/show');
	}

	F3::set('error', "Girdiğiniz bilgilere uygun bir kayıt bulunamadı. Lütfen verdiğiniz bilgileri kontrol edin.");
}

// hata var, dön başa ve tekrar sorgu al.
// error alanı dolu ve layout.htm'de görüntülenecek
F3::call('sorgu');

?>
