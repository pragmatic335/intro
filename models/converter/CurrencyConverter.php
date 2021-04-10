<?php

namespace app\models\converter;


use yii\base\Exception;

class CurrencyConverter
{
    const CUR = [
        'RUB' => 'RUB',
        'USD' => 'USD',
        'EUR' => 'EUR'
    ];

    public int $precision = 2;

    protected CurrencyCbr $currencyCbr;

    public function __construct(CurrencyCbr $rate)
    {
        $this->currencyCbr = $rate;
    }

    /**
     * @param string $beginCurrency Конвертируемая
     * @param string $endCurrency На выходе
     * @param float $sum количество денежных единиц
     * @throws Exception
     * @return float
     */
    public function convert(float $sum, string $beginCurrency, string $endCurrency): float
    {
        if( !in_array($beginCurrency, static::CUR) || !in_array($endCurrency, static::CUR) ) {
            throw new Exception('Невозможно конвентировать данную валюту!');
        }

        if($beginCurrency == self::CUR['RUB'] && $endCurrency == self::CUR['RUB']) {
            return $sum;
        }
        elseif($endCurrency == self::CUR['RUB']) {
            return round( $this->currencyCbr->getCurrency($beginCurrency, $this->precision) * $sum, $this->precision);
        }
        elseif($beginCurrency == self::CUR['RUB']) {
            return round($sum/$this->currencyCbr->getCurrency($endCurrency, $this->precision + 1), 2);
        }

        //курс конвертируемой
//        echo static::CUR[$beginCurrency]; die();

        $first = $this->currencyCbr->getCurrency(static::CUR[$beginCurrency], $this->precision);
        //курс выходной
        $second = $this->currencyCbr->getCurrency(static::CUR[$endCurrency], $this->precision);
        //коэффициет
        $index =  $first/$second;



        return round($index * $sum, $this->precision);
    }

}