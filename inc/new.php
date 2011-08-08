<?php
date_default_timezone_set("Turkey");

// FIXME yavrum sen niye buradasın?
function iller() {
	return array(
		'',
		'YURT DIŞI',
		'Adana',
		'Adıyaman',
		'Afyonkarahisar',
		'Ağrı',
		'Aksaray',
		'Amasya',
		'Ankara',
		'Antalya',
		'Ardahan',
		'Artvin',
		'Aydın',
		'Balıkesir',
		'Bartın',
		'Batman',
		'Bayburt',
		'Bilecik',
		'Bingöl',
		'Bitlis',
		'Bolu',
		'Burdur',
		'Bursa',
		'Çanakkale',
		'Çankırı',
		'Çorum',
		'Denizli',
		'Diyarbakır',
		'Düzce',
		'Edirne',
		'Elazığ',
		'Erzincan',
		'Erzurum',
		'Eskişehir',
		'Gaziantep',
		'Giresun',
		'Gümüşhane',
		'Hakkari',
		'Hatay',
		'Iğdır',
		'Isparta',
		'İstanbul',
		'İzmir',
		'Kahramanmaraş',
		'Karabük',
		'Karaman',
		'Kars',
		'Kastamonu',
		'Kayseri',
		'Kırıkkale',
		'Kırklareli',
		'Kırşehir',
		'Kilis',
		'Kocaeli',
		'Konya',
		'Kütahya',
		'Malatya',
		'Manisa',
		'Mardin',
		'Mersin',
		'Muğla',
		'Muş',
		'Nevşehir',
		'Niğde',
		'Ordu',
		'Osmaniye',
		'Rize',
		'Sakarya',
		'Samsun',
		'Siirt',
		'Sinop',
		'Sivas',
		'Şanlı urfa',
		'Şırnak',
		'Tekirdağ',
		'Tokat',
		'Trabzon',
		'Tunceli',
		'Uşak',
		'Van',
		'Yalova',
		'Yozgat',
		'Zonguldak',
	);
}
function ulkeler() {
	return array(
		'',
		'Türkiye',
		'Abhazya',
		'Afganistan',
		'Almanya',
		'Amerika Birleşik Devletleri',
		'Andorra',
		'Angola',
		'Antigua ve Barbuda',
		'Arjantin',
		'Arnavutluk',
		'Avustralya',
		'Avusturya',
		'Azerbaycan',
		'Bahamalar',
		'Bahreyn',
		'Bangladeş',
		'Barbados',
		'Batı Sahra',
		'Belarus',
		'Belçika',
		'Belize',
		'Benin',
		'Bhutan',
		'Birleşik Arap Emirlikleri',
		'Bolivya',
		'Bosna Hersek',
		'Botsvana',
		'Brezilya',
		'Brunei',
		'Bulgaristan',
		'Burkina Faso',
		'Burundi',
		'Cezayir',
		'Cibuti Cumhuriyeti',
		'Çad',
		'Çek Cumhuriyeti',
		'Çin Halk Cumhuriyeti',
		'Dağlık Karabağ Cumhuriyeti',
		'Danimarka',
		'Doğu Timor',
		'Dominik Cumhuriyeti',
		'Dominika',
		'Ekvador',
		'Ekvator Ginesi',
		'El Salvador',
		'Endonezya',
		'Eritre',
		'Ermenistan',
		'Estonya',
		'Etiyopya',
		'Fas',
		'Fiji',
		'Fildişi Sahilleri',
		'Filipinler',
		'Filistin',
		'Finlandiya',
		'Fransa',
		'Gabon',
		'Gambiya',
		'Gana',
		'Gine Bissau',
		'Gine',
		'Grenada',
		'Guyana',
		'Guatemala',
		'Güney Afrika Cumhuriyeti',
		'Güney Kore',
		'Güney Osetya',
		'Gürcistan',
		'Haiti',
		'Hırvatistan',
		'Hindistan',
		'Hollanda',
		'Honduras',
		'Irak',
		'İngiltere',
		'İran',
		'İrlanda',
		'İspanya',
		'İsrail',
		'İsveç',
		'İsviçre',
		'İtalya',
		'İzlanda',
		'Jamaika',
		'Japonya',
		'Kamboçya',
		'Kamerun',
		'Kanada',
		'Karadağ',
		'Katar',
		'Kazakistan',
		'Kenya',
		'Kırgızistan',
		'Kıbrıs Cumhuriyeti',
		'Kiribati',
		'Kolombiya',
		'Komorlar',
		'Kongo',
		'Kongo Demokratik Cumhuriyeti',
		'Kosova',
		'Kosta Rika',
		'Kuveyt',
		'Kuzey Kıbrıs Türk Cumhuriyeti',
		'Kuzey Kore',
		'Küba',
		'Lakota Cumhuriyeti',
		'Laos',
		'Lesotho',
		'Letonya',
		'Liberya',
		'Libya',
		'Liechtenstein',
		'Litvanya',
		'Lübnan',
		'Lüksemburg',
		'Macaristan',
		'Madagaskar',
		'Makedonya Cumhuriyeti',
		'Malavi',
		'Maldivler',
		'Malezya',
		'Mali',
		'Malta',
		'Marshall Adaları',
		'Meksika',
		'Mısır',
		'Mikronezya',
		'Moğolistan',
		'Moldova',
		'Monako',
		'Moritanya',
		'Moritus',
		'Mozambik',
		'Myanmar',
		'Namibya',
		'Nauru',
		'Nepal',
		'Nikaragua',
		'Nijer',
		'Nijerya',
		'Norveç',
		'Orta Afrika Cumhuriyeti',
		'Özbekistan',
		'Pakistan',
		'Palau',
		'Panama',
		'Papua Yeni Gine',
		'Paraguay',
		'Peru',
		'Polonya',
		'Portekiz',
		'Romanya',
		'Ruanda',
		'Rusya Federasyonu',
		'Saint Kitts ve Nevis',
		'Saint Lucia',
		'Saint Vincent ve Grenadinler',
		'Samoa',
		'San Marino',
		'Sao Tome ve Principe',
		'Sealand',
		'Senegal',
		'Seyşeller',
		'Sırbistan',
		'Sierra Leone',
		'Singapur',
		'Slovakya',
		'Slovenya',
		'Solomon Adaları',
		'Somali',
		'Somaliland',
		'Sri Lanka',
		'Sudan',
		'Surinam',
		'Suudi Arabistan',
		'Suriye',
		'Svaziland',
		'Şili',
		'Tacikistan',
		'Tamil Eelam',
		'Tanzanya',
		'Tayland',
		'Tayvan',
		'Togo',
		'Tonga',
		'Transdinyester',
		'Trinidad ve Tobago',
		'Tunus',
		'Tuvalu',
		'Türkmenistan',
		'Uganda',
		'Ukrayna',
		'Umman',
		'Uruguay',
		'Ürdün',
		'Vanuatu',
		'Vatikan',
		'Venezuela',
		'Vietnam',
		'Yemen',
		'Yeni Zelanda',
		'Yeşil Burun',
		'Yunanistan',
		'Zambiya',
		'Zimbabve',
	);
}
function gunler() {
	$ret = range(1, 31); array_unshift($ret, '');
	return $ret;
}
function aylar() {
	$ret = range(1, 12); array_unshift($ret, '');
	return $ret;
}
function yillar($enfazla=70) {
	$busene = date('Y');
	// sorarım size insan kaç sene yaşar?
	$ret = range($busene, $busene - $enfazla); array_unshift($ret, '');
	return $ret;
}

F3::clear('SESSION.captcha');
F3::clear('SESSION.tc');

F3::set('gunler', gunler());
F3::set('aylar', aylar());
F3::set('yillar', yillar());
F3::set('iller', iller());
F3::set('ulkeler', ulkeler());

F3::set('title', 'Kayıt Formu');
F3::set('template', 'goster');
F3::call('layout');

?>
