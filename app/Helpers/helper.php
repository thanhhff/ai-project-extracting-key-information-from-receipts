<?php
namespace App\Helpers;

if (!function_exists('format_currency')) {

    function format_currency($amount)
    {
        if(empty($amount)) return "";
        $result = is_numeric($amount) ? number_format($amount) : $amount;
        $result .= " VND";
        return $result;
    }
}

if (!function_exists('format_date')) {

    function format_date($date)
    {
        if(empty($date)) return "";
        $date = strtotime($date);
        return date("d/m/Y", $date);
    }
}