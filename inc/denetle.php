<?php
include 'init.php';
// tum dosyalar icin ortak denetlemedir,
// uzerine ek denetleme yapmanız gerekiyorsa
// bu dosyayi cagirdiginiz kisimda yapiniz(<local>de) bu dosyaya dokanmayiniz!
function yukle($hedef=NULL, $alan='file') {
	$yuklenen = F3::get("FILES.$alan.tmp_name");

	// hedef ve yüklenen dosyanın boş olmasına izin veriyoruz
	// herhangi biri boşsa mesele yok, çağırana dön
	if (empty($hedef) || empty($yuklenen)) {
		return true;
	}
	// bu bir uploaded dosya olmalı, fake dosyalara izin yok
	if (is_uploaded_file($yuklenen)) {
		// boyutu sınırla, değeri öylesine seçtim
		if (filesize($yuklenen) > 600000) {
			F3::set('error', 'Resim çok büyük');
		}
		// şimdilik sadece JPEG, dosya tipini içine bakarak tespit ediyoruz
		else if (exif_imagetype($yuklenen) != IMAGETYPE_JPEG) {
			F3::set('error', 'Resim JPEG değil');
		}
		// dosyanın üzerine yazmayalım, ekstra güvenlik
		else if (file_exists($hedef)) {
			F3::set('error', 'Resim zaten kaydedilmiş');
		}
		// tamamdır, kalıcı kayıt yapalım
		else if (!move_uploaded_file($yuklenen, $hedef)) {
			F3::set('error', 'Dosya yükleme hatası');
		}
		// yok başka bir ihtimal!
	}
	else {
		// bu aslında bir atak işareti
		F3::set('error', 'Dosya geçerli bir yükleme değil');
	}

	return false;
}

function is_tc($tc) {
	// Kaynak: is_tc(): http://www.kodaman.org/yazi/t-c-kimlik-no-algoritmasi
	preg_replace(
			'/([1-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1})([0-9]{1}).*$/e',
			"eval('
			\$on=((((\\1+\\3+\\5+\\7+\\9)*7)-(\\2+\\4+\\6+\\8))%10);
			\$onbir=(\\1+\\2+\\3+\\4+\\5+\\6+\\7+\\8+\\9+\$on)%10;
			')",
			$tc
	);

	// $on ve $onbir set edilmeden yola devam etmek yok.
	if (!isset($on) || !isset($onbir)) return false;

	// son iki haneyi (on ve onbirinci) kontrol et
	return substr($tc, -2) == ($on < 0 ? 10 + $on : $on) . $onbir;
}

// FIXME: bunu bir işlev tablosuna dönüştür
function denetle($verilen, $tarif) {
	foreach ($tarif as $ne => $bilgi) {
		$kosul = array_shift($bilgi);
		switch ($ne) {
		case 'dolu':
			$hata = $kosul && empty($verilen);
			break;
		case 'esit':
			$hata = $kosul != strlen($verilen);
			break;
		case 'enfazla':
			$hata = strlen($verilen) > $kosul;
			break;
		case 'enaz':
			$hata = strlen($verilen) < $kosul;
			break;
		case 'degeri':
			$hata = $kosul != $verilen;
			break;
		case 'tamsayi':
			$hata = $kosul && ! ctype_digit($verilen);
			break;
		case 'ozel':
			$hata = $kosul && $kosul($verilen);
			break;
		}
		if ($hata) {
			return array_shift($bilgi);
		}
	}
}

// temiz bir sayfa açalım!
F3::clear('error');

// captcha'sız maça çıkmayız, sağlam gidelim
//if (! F3::exists('SESSION.captcha')) {
if (! F3::get('SESSION.captcha')) {
	F3::set('error', 'Oturum Güvenlik Kodu eksik');
	return;
}

// captcha tamam mı?
F3::input($alan='captcha',
	function($value) use($alan) {
		$ne = "Güvenlik Kodu";
		$captcha = F3::get('SESSION.captcha');
		if ($hata = denetle(strtolower($value), array(
			'dolu'   => array(true,                 "$ne boş bırakılamaz"),
			'enaz'   => array(strlen($captcha),     "$ne çok kısa"),
			'degeri' => array(strtolower($captcha), "Yanlış $ne"),
		))) { F3::set('error', $hata); return; }
	}
);

?>
