<?php
require_once 'lib/base.php';

function page($title, $template, $layout) {
	F3::set('title', $title);
	F3::set('template', $template);
	F3::call($layout);
}

function layout()  { echo Template::serve('layout.htm');         }
function captcha() { Graphics::captcha(150,60,5,'jester');       }

function ok()      { page('Kayıt yapıldı',  'ok',     'layout'); }
function sorgu()   { page('Sorgu Formu',   'sorgu',   'layout'); }
function sorguok() { page('Sorgu Yapıldı', 'sorguok', 'layout'); }

F3::config(".f3.ini");
F3::set('DB', new DB('mysql:host=localhost;port=3306;dbname=' . F3::get('dbname'), F3::get('dbuser'), F3::get('dbpass')));
F3::set('SERVICEROOT', '/' . strtok($_SERVER["SCRIPT_NAME"], '/'));

F3::route("GET  /captcha",     'captcha');
F3::route("GET  /",            'goster.php');
F3::route("POST /kaydet",      'kaydet.php');
F3::route("GET  /ok",          'ok');
F3::route("GET  /cikti",       'cikti.php');

F3::route("GET  /sorgu",       'sorgu');
F3::route("GET  /sorguok",     'sorguok');
F3::route("POST /sorguyap",    'sorguyap.php');
F3::route("GET  /sorgucikti",  'sorgucikti.php');

F3::run();
?>

