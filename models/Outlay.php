<?php


namespace app\models;


use app\models\converter\CurrencyCbr;
use app\models\converter\CurrencyConverter;
use Yii;
use yii\db\Expression;

class Outlay
{
    public FilterForm $filter;

    public float $summa = 0;

    public array $categories = [];
    public array $data = [];

    public function __construct(FilterForm $filter)
    {
        $this->filter = $filter;
    }

    public function setParams()
    {
        $converter = new CurrencyConverter(new CurrencyCbr());
        $format = 'm-d-Y';

        $query = (new \yii\db\Query())
            ->select('charges.id id,charges.type_id type, charges.sum summa, currencies.name currency, charges.createdate')
            ->from('categories')
            ->innerJoin('objects', 'objects.category_id = categories.id')
            ->innerJoin('charges', 'charges.object_id = objects.id')
            ->innerJoin('currencies', 'currencies.id = charges.currency_id')
            ->where(['charges.type_id' => 2])
            ->orderBy('charges.createdate');

        if( $this->filter->category) {
            $query->andWhere(['categories.id' => $this->filter->category]);
        }

        if( $this->filter->object) {
            $query->andWhere(['objects.id' => $this->filter->object]);
        }
//        date("d.m.Y");
        if($this->filter->bdate && $this->filter->edate) {
            $bdate = date_create($this->filter->bdate);
            $edate = date_create($this->filter->edate);

            $query->andWhere(new Expression('charges.createdate between \'' . date_format($bdate, $format) . '\' and \'' .date_format($edate, $format)  . '\''));
        }
        elseif($this->filter->bdate && !$this->filter->edate) {
            $bdate = date_create($this->filter->bdate);
            $query->andWhere(['>=', 'charges.createdate',date_format($bdate, $format)]);
//            echo $query->createCommand()->rawSql; die();
        }
        elseif(!$this->filter->bdate && $this->filter->edate) {
            $edate = date_create($this->filter->edate);
            $query->andWhere(['<=', 'charges.createdate',date_format($edate, $format)]);
        }


        if( !$this->filter->currency ) {
//            echo $query->createCommand()->rawSql; die();
            foreach($query->each() as $row) {
                $this->summa = $this->summa + $converter->convert($row['summa'], $row['currency'], 'RUB');
                $this->categories[] =  Yii::$app->formatter->format($row['createdate'], 'date');
                $this->data[] = $converter->convert($row['summa'], $row['currency'], 'RUB');
//                $result = $result + $converter->convert($row['summa'], $row['currency'], 'RUB');
            }
        }
        else {
            $currency = Currencies::findOne($this->filter->currency)['name'];
            foreach($query->each() as $row) {
                $this->summa = $this->summa + $converter->convert($row['summa'], $row['currency'], $currency);
                $this->categories[] =  Yii::$app->formatter->format($row['createdate'], 'date');
                $this->data[] = $converter->convert($row['summa'], $row['currency'], $currency);
//                $result = $result + $converter->convert($row['summa'], $row['currency'], $currency);
            }
        }

//        return $this;
//        echo   $this->summa; die();

//        return $result;
    }

}