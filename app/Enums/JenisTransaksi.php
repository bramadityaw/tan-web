<?php
namespace App\Enums;

enum JenisTransaksi: string {
    case Jual = 'penjualan';
    case Beli = 'pembelian';
}
