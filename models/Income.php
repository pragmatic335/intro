<?php


namespace app\models;


use app\models\converter\CurrencyCbr;
use app\models\converter\CurrencyConverter;
use yii\db\Expression;

class Income
{
    public FilterForm $filter;

    public function __construct(FilterForm $filter)
    {
        $this->filter = $filter;
    }

    public function getIncome()
    {
        $result = 0;
        $converter = new CurrencyConverter(new CurrencyCbr());

        $query = (new \yii\db\Query())
            ->select('charges.id id,charges.type_id type, charges.sum summa, currencies.name currency')
            ->from('categories')
            ->innerJoin('objects', 'objects.category_id = categories.id')
            ->innerJoin('charges', 'charges.object_id = objects.id')
            ->innerJoin('currencies', 'currencies.id = charges.currency_id')
            ->where(['charges.type_id' => 1]);


        if( !$this->filter->currency ) {
            foreach($query->each() as $row) {
                $result = $result + $converter->convert($row['summa'], $row['currency'], 'RUB');
            }
        }
        else {
            $currency = Currencies::findOne($this->filter->currency)['name'];
            foreach($query->each() as $row) {
                $result = $result + $converter->convert($row['summa'], $row['currency'], $currency);
            }
        }

        echo $result; die();

        return $result;
    }

}