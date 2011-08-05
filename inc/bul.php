<?php

$kul = new Axon('kul');
$tc = F3::get('REQUEST.tc');
// kişinin tc yi oturuma gömelim
F3::set('SESSION.tc', $tc);

if ($kul->found("tc = $tc")) {
	$user = $kul->find("tc = $tc");
	// user set edelim
	F3::set('user', $user[0]);
	return F3::call('user');
}
else 
    	F3::set('error','böyle bir kayıt bulunmamaktadır');

// kişi bulunmazsa tekrar iste
F3::call('adminok');
?>
