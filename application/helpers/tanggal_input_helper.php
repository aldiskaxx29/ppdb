<?php
function tanggal_format_sql($tanggal)
{
    $tgl = explode('/', strval($tanggal));
    return $tgl[1] . '-' . $tgl[0] . '-' . $tgl[2];
}

function tanggal_format_input($tanggal)
{
    $tgl = explode('-', strval($tanggal));
    return $tgl[1] . '/' . $tgl[0] . '/' . $tgl[2];
}
