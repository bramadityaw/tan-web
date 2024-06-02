<?php

use Carbon\Carbon;

function rupiah(int $amount) : string {
    return 'Rp. ' . number_format($amount,2, ',' , '.');
}

function tanggalIdn(string $date, string $format) : string {
    return Carbon::parse($date)->translatedFormat($format);
}


function allCapsToCapCase (string $sentence)
{
    $words = explode(' ', $sentence);
    $res = '';
    foreach ($words as $word)
    {
        $res .= $word[0] . strtolower(substr($word, 1)) . ' ';
    }
    return trim($res);
}
