<?php
include 'control.php';
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
	$ev_split = preg_split('[\n]', $kul->evadres);
	$ev = "";
	foreach($ev_split as $k)
		$ev = $ev . ' ' . rtrim($k);
	$ev = preg_split('[,]', $ev);
	$ev = implode($ev, ' ');
	$kul->evadres = $ev;

	$is_split = preg_split('[\n]', $kul->isadres);
	$is = "";
	foreach($is_split as $k)
		$is = $is . ' ' . rtrim($k);
	$is = preg_split('[,]', $is);
	$is = implode($is, ' ');
	$kul->isadres = $is;

	if($kul->dogumulke=="")
		$kul->dogumulke="Türkiye";
	$tc = $kul->tc;
	F3::set('tc', $tc);

	if (! empty($tc)) {
		$resim = $kul->tc . '.jpg';
		$kul->photo = $resim;
		$path = F3::get('uploaddir') . $resim;
		// resimi yukleyip denetleyelim
		//
		//
		if (yukle($path, "file", false)) // resim yükle ve üzerine yazılmasın!
			$kul->photo = $resim;
		else
			$kul->photo = "default.png"; // default resim
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
F3::call('new.php');
?>
