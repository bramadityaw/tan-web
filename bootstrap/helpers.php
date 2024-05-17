<?php

use Carbon\Carbon;

function rupiah(int $amount) : string {
    return 'Rp. ' . number_format($amount,2, ',' , '.');
}

function tanggalIdn(string $date, string $format) : string {
    return Carbon::parse($date)->translatedFormat($format);
}
