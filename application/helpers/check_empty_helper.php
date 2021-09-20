<?php
function check_empty($var)
{
    if (isset($var) || !empty($var)) {
        return $var;
    } else {
        return '-';
    }
}
