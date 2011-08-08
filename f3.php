<?php
require_once 'lib/base.php';

function page($title, $template, $layout) {
	F3::set('title', $title);
	F3::set('template', $template);
	F3::call($layout);
}

function layout()  { echo Template::serve('layout.htm');      }
function captcha() { Graphics::captcha(150, 60, 5, 'jester'); }

function ok()      { page('Kayıt yapıldı', 'ok', 'layout');   }
function sorgu()   {
	F3::clear('SESSION.photo');
	F3::clear('SESSION.tc');
        F3::clear('SESSION.kizliksoyad');
	page('Sorgu Formu', 'sorgu', 'layout');
}
function show() { page('Sorgu Yapıldı', 'show', 'layout'); }

F3::config(".f3.ini");
F3::set('DB', new DB('mysql:host=localhost;port=3306;dbname=' . F3::get('dbname'), F3::get('dbuser'), F3::get('dbpass')));
F3::set('SERVICEROOT', '/' . strtok($_SERVER["SCRIPT_NAME"], '/'));

F3::route("GET  /captcha", 'captcha');
F3::route("GET  /",        'new.php');
F3::route("POST /save",    'save.php');
F3::route("GET  /ok",      'ok');
F3::route("GET  /pdf",     'pdf.php');

F3::route("GET  /sorgu",   'sorgu');
F3::route("POST /find",    'find.php');
F3::route("GET  /show",    'show');

F3::run();
?>

