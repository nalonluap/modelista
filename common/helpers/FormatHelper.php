<?php
namespace common\helpers;

class FormatHelper
{
    /**
     * @param $n
     * @param $forms
     * @return mixed
     */
    public static function plural($n, $forms)
    {
        return $n % 10 == 1 && $n % 100 != 11 ? $forms[ 0 ] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[ 1 ] : $forms[ 2 ]);
    }

    public static function price($price, $discount = 0, $currency = '', $benefit=false)
    {
        if (!isset($price)) {
            return '-';
        }
        $a = (doubleval($price) - doubleval($price) * doubleval($discount) / 100);
        $b = round($a);
        $out = $benefit? (number_format(doubleval($price) - $b, 0, ',', ' ')):(number_format($b, 0, ',', ' '));
        $out .= $currency ? '' . $currency : '';
        return $out;
    }

    public static function priceDiscount($price, $discount = 0)
    {
        return round($price - $price * $discount / 100);
    }

}
