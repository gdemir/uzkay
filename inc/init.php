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
