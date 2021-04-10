<?php


namespace app\models\converter;


interface CurrencyInterface
{
    public function getCurrency(string $currency_code, int $format): float;
}