<?php
/**
 * @var $model app\models\FilterForm
 * @var $income app\models\Income
 * @var $outlay app\models\Outlay
 */

use app\assets\FilterAsset;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

/**
 * Фильтр поиска. Вне Pjax
 */
echo $this->render('_filter', ['model' => $model]);

Pjax::begin(['id' => 'filter-pjax', 'enablePushState' => true, 'timeout' => false]);


echo $this->render('_filterhide', ['model' => $model]);

echo $this->render('_charge', ['model' => $model , 'income' => $income, 'outlay' => $outlay]);

echo $this->render('_income-outlay-charts', ['model' => $model , 'income' => $income, 'outlay' => $outlay]);

echo $this->render('_balance-chart', ['model' => $model , 'income' => $income, 'outlay' => $outlay]);

?>

<?php
Pjax::end();
FilterAsset::register($this);

?>