<?php

function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
