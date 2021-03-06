<?php
// heryerde kullanilmayi dusundugumuz fonksiyonlari barindirdigimiz dosya

function strtolower_turkish($string) {
        $lower = array(
                'İ' => 'i', 'I' => 'ı', 'Ğ' => 'ğ', 'Ü' => 'ü',
                'Ş' => 'ş', 'Ö' => 'ö', 'Ç' => 'ç',
        );
        return strtolower(strtr($string, $lower));
}

function streq_turkish($string1, $string2) {
        return strtolower_turkish($string1) == strtolower_turkish($string2);
}

?>
<?php
// ana pdf şsablonu
function pdf($kul) {
	require("/opt/tcpdf/tcpdf.php");

	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('OMU UZEM 2011-2012 ÖN KAYIT FORMU');
	$pdf->SetAuthor('Anonim');
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetMargins(20, 60, 20);
	$pdf->SetHeaderMargin(10);
	$pdf->SetFooterMargin(10);
	$pdf->SetHeaderData('uzem-head.png', 170, '', '');

	$pdf->AddPage();

	$pdf->SetFont('dejavusans', 'B', 18);
	$pdf->Cell(0, 5, "2011-2012 Ebelik Lisans Tamamlama", 0, 1, 'C');
	$pdf->Cell(0, 5, "Ön Kayıt Başvurusu", 0, 1, 'C');
	$pdf->Ln(5);

	$bilgiler = array(
		'Kişisel Bilgiler' => array(
			'tc'		=> 'TC Kimlik No',
			'ad'		=> 'Ad',
			'soyad'		=> 'Soyad',
			'kizliksoyad'	=> 'Kızlık Soyadı',
			'babaad'	=> 'Baba Adı',
			'anaad'		=> 'Ana Adı',
			'dogumil'	=> 'Doğum Yeri',
			'dogumyil'	=> 'Doğum Yılı',
		),
		'İletişim Bilgiler' => array(
			'ceptel'	=> 'Cep Tel',
			'evtel'		=> 'Ev Tel',
			'email'		=> 'Email',
			'evadres'	=> 'Ev Adres',
			'il'		=> 'İl',
			'ilce'		=> 'İlçe',
			'uni'		=> 'Üniversite',
		),
		'İş Bilgiler' => array(
			'calismakurum'	=> 'Kurum',
			'calismabirim'	=> 'Birim',
			'istel'		=> 'İş Tel',
			'isadres'	=> 'İş Adres',
			'isil'		=> 'İl',
			'isilce'	=> 'İlçe',
		),
		'Diğer Bilgiler' => array(
			'tarih'		=> 'Ön Kayıt Tarihi',
		),
	);

	foreach ($bilgiler as $kesim => $bilgi) {
		$pdf->SetFont('dejavusans', 'B', 14);
		$pdf->Cell(0, 5, $kesim, 0, 1, 'L');

		$pdf->SetFont('dejavusans', '', 10);
		foreach ($bilgi as $alan => $baslik) {
			$deger = $kul->$alan;
			$pdf->MultiCell(30, 1, $baslik . ':', 0, 'L', 0, 0, '25', '', true);
			$pdf->MultiCell(180, 1, $deger,       0, 'L', 0, 0, '',   '', true);
			$pdf->Ln(5);
		}

		$pdf->Ln(5);
	}

	$pdf->Ln(15);

	$pdf->Cell(0, 5, "Yukarıda vermiş olduğum bilgilerin doğruluğunu kabul ediyorum.", 0, 1,'T'); 
	$pdf->Ln(5);
	$pdf->MultiCell(50, 1, 'Tarih:', 0, 'L', 0, 1, '120', '', true);
	$pdf->MultiCell(50, 1, 'Ad Soyad:', 0, 'L', 0, 1, '120', '', true);
	$pdf->MultiCell(50, 1, 'İmza:', 0, 'L', 0, 1, '120', '', true);

	$pdf->Output();
}
?>
