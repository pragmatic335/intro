<?php


namespace app\models\converter;

/**
 * Честно
 * украденная процедура из сети
 * Class CurrencyCbr
 * @package app\models
 */
class  CurrencyCbr
{
    public function getCurrency($currency_code, $format) : float
    {
        $date = date('d/m/Y'); // Текущая дата
        $cache_time_out = '3600'; // Время жизни кэша в секундах

        $file_currency_cache = __DIR__.'/XML_daily.asp';

        if(!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            $out = curl_exec($ch);

            curl_close($ch);

            file_put_contents($file_currency_cache, $out);

        }

        $content_currency = simplexml_load_file($file_currency_cache);

        return (float) number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);

    }
}