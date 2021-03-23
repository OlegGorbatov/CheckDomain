<?php
//namespace domain\libraries;

/**
* Библиотека содержащая две функции для проверки вхождения домена А, в домен B
* isDomainApartB(string A, string B) - функция проверки вхождения
* domainValidate(A, B) - функция проверки корретности передаваемых данных
*
* php version 7.2
 *
* @author Oleg Gorbatov <o.i.gorbatov@yandex.ru>
* @version 1.0
* @since 24.03.2021
 */

/* Данные для тестирования функции проверки вхождения домена А в домен В (корректные ) */
//$a0 = "x.foo.com";
//$a1 = "x.y.foo.com";
//$a2 = "foo.com";
//$c0 = "bar.com";
//$c1 = "x.baz.com";
//$b = "foo.com";

/* Тестирование */
//$msg = isDomainApartB($a0, $b) ? 'Входит А в B' : 'НЕ входит А в B';
//$msg = isDomainApartB($a1, $b) ? 'Входит А в B' : 'НЕ входит А в B';
//$msg = isDomainApartB($a2, $b) ? 'Входит А в B' : 'НЕ входит А в B';
//$msg = isDomainApartB($c0, $b) ? 'Входит А в B' : 'НЕ входит А в B';
//$msg = isDomainApartB($c1, $b) ? 'Входит А в B' : 'НЕ входит А в B';
//$msg = isDomainApartB('', '.') ? 'Входит А в B' : 'НЕ входит А в B';

//echo $msg;

/**
 * Функция проверки вхождения домена subDomain в домен, идентифицируемый доменным именем mainDomain
 * Считатется, что в функцию всегда передаются валидные доменные имена относительно корневого домена.
 * Под корневым доменом подразумевается домен самого верхнего уровня (домен нулевого уровня).
 *
 * @param string $mainDomain
 * @param string $subDomain
 * @return bool
 */
function isDomainApartB(string $subDomain, string $mainDomain):bool  {
    for ($i = strlen($mainDomain); $i > 0; $i-- ){
        if (substr($mainDomain, -1) === substr($subDomain, -1)){
            $mainDomain = substr($mainDomain,0,-1);
            $subDomain = substr($subDomain,0,-1);
        } else {
            return FALSE;
        }
    }
    return TRUE;
}

/**
 * Функция служит для проверки данных передоваемых как домены.
 * Сейчас проверяет на пустоту данных, но легко расширяема до нужной проверки.,
 *
 * @param string $mainDomain
 * @param string $subDomain
 * @return array
 */
function domainValidate($mainDomain = '', $subDomain = ''):array {
    $messageA = '';
    $messageB = '';
    $error = '';

    if (empty($mainDomain)){
        $messageA = 'Ошибка при вводе основного домена <br />';
        $error = 'true';
    }
    if (empty($subDomain)){
        $messageB = 'Ошибка при вводе проверяемого домена <br />';
        $error = 'true';
    }

    return [
        'message' => $messageA . " "  . $messageB,
        'error' => $error
    ];
}