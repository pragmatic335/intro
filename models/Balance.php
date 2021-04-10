<?php


namespace app\models;


use app\models\converter\CurrencyCbr;
use app\models\converter\CurrencyConverter;
use Yii;
use yii\db\Expression;

class Balance
{
    public FilterForm $filter;

    public float $summa = 0;

    public array $categories = [];
    public array $data = [];

    public $cur;

    public function __construct(FilterForm $filter)
    {
        $this->filter = $filter;
    }

    public function setParams()
    {
        if(!$this->filter->currency) {
            $this->cur = 'RUB';
        }
        else {
            $this->cur = Currencies::findOne($this->filter->currency)['name'];
        }


        $tabIncome = '
            select  c.id as id,
                    c.type_id as type,
                    c.sum as summa,
                    cur.name as currency,
                    cat.id as category,
                    obj.id as object,
                    c.createdate as createdate
                from categories as cat
                join objects as obj on obj.category_id = cat.id
                join charges as c on c.object_id = obj.id
                join currencies as cur on cur.id = c.currency_id
            where
            (c.type_id = 1)';

        $tabOutlay = '
            select  c.id as id,
                    c.type_id as type,
                    c.sum as summa,
                    cur.name as currency,
                    cat.id as category,
                     obj.id as object,
                    c.createdate as createdate
                from categories as cat
                join objects as obj on obj.category_id = cat.id
                join charges as c on c.object_id = obj.id
                join currencies as cur on cur.id = c.currency_id
            where
            (c.type_id = 2)';

        $tabInc = '
            select  i.createdate,
                    i.type itype,
                    o.type otype,
                    i.currency icurrency,
                    o.currency ocurrency,
                    i.category,
                    i.object,
                    i.summa isumma,
                    CASE
                         WHEN o.summa is null  THEN 0
                         ELSE o.summa 
                    end as osumma
  			    from income i
 		 		left join outlay o on o.createdate = i.createdate ';

        $tabOutl = '
            select  o.createdate,
                    i.type itype,
                    o.type otype,
                    i.currency icurrency,
                    o.currency ocurrency,
                    o.category,
                    o.object,
                    CASE
                         WHEN i.summa is null  THEN 0
                         ELSE i.summa 
                    end as isumma,
                    o.summa osumma
  			    from income i
 		 		right join outlay o on o.createdate = i.createdate ';

        $tabRes = 'select * 
 			        from inc 
 			       union
 			        select *
 			       from outl';

        $sql = 'with income as (' . $tabIncome .'),
                     outlay as (' . $tabOutlay .'),
                     inc as (' . $tabInc .'),
                     outl as (' . $tabOutl .'),
                     res as (' . $tabRes .')
                select *
                  from res
                where 1=1 ';

        $converter = new CurrencyConverter(new CurrencyCbr());
        $format = 'm-d-Y';

        if( $this->filter->category) {
            $sql .= ' and (res.category = ' . $this->filter->category . ') ';
        }

        if( $this->filter->object) {
            $sql .= ' and (res.object = ' . $this->filter->object . ') ';
        }

        if($this->filter->bdate && $this->filter->edate) {
            $bdate = date_create($this->filter->bdate);
            $edate = date_create($this->filter->edate);
            $sql .= ' and (res.createdate between \'' . date_format($bdate, $format) . '\' and \'' . date_format($edate, $format) . '\') ';
        }
        elseif($this->filter->bdate && !$this->filter->edate) {
            $bdate = date_create($this->filter->bdate);
            $sql .= ' and (res.createdate >= \'' . date_format($bdate, $format) .'\') ';
        }
        elseif(!$this->filter->bdate && $this->filter->edate) {
            $edate = date_create($this->filter->edate);
            $sql .= ' and (res.createdate <= \'' . date_format($edate, $format) .'\') ';
        }

        $list = Yii::$app->db->createCommand($sql)->queryAll();

        if( !$this->filter->currency ) {
            foreach($list as $row) {
                $icurrency = $row['icurrency'];

                $isumm = 0;
                if($icurrency) {
                    $isumm = $converter->convert($row['isumma'], $icurrency, 'RUB');
                }

                $ocurrency = $row['ocurrency'];
                $osumm = 0;
                if($ocurrency) {
                    $osumm = $converter->convert($row['osumma'], $ocurrency, 'RUB');
                }

                $this->summa += $isumm - $osumm;
                $this->categories[] =  Yii::$app->formatter->format($row['createdate'], 'date');

                $this->data[] =  round ($this->summa, 2);
            }
        }
        else {
            $currency = Currencies::findOne($this->filter->currency)['name'];

            foreach($list as $row) {
                $icurrency = $row['icurrency'];

                $isumm = 0;
                if($icurrency) {
                    $isumm = $converter->convert($row['isumma'], $icurrency, $currency);
                }

                $ocurrency = $row['ocurrency'];
                $osumm = 0;
                if($ocurrency) {
                    $osumm = $converter->convert($row['osumma'], $ocurrency, $currency);
                }

                $this->summa += $isumm - $osumm;
                $this->categories[] =  Yii::$app->formatter->format($row['createdate'], 'date');
                $this->data[] = round ($this->summa, 2);
            }
        }

    }
}