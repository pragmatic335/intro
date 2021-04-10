<?php
/**
 * @var $model app\models\FilterForm
 * @var $income app\models\Income
 * @var $outlay app\models\Outlay
 * @var $balance app\models\Balance
 */

use app\assets\FilterAsset;
use yii\widgets\Pjax;

// фильтр поиска. Вне pjax
echo $this->render('_filter', ['model' => $model]);

Pjax::begin(['id' => 'filter-pjax', 'enablePushState' => true, 'timeout' => false]);

// Скрытая форма значений фильтра. Именно ее сабмитим
echo $this->render('_filterhide', ['model' => $model]);

// блоки: дохода, расхода, баланса
echo $this->render('_charge', ['model' => $model , 'income' => $income, 'outlay' => $outlay, 'balance' => $balance]);

// отрисовка графиков: дохода, расхода
echo $this->render('_income-outlay-charts', ['model' => $model , 'income' => $income, 'outlay' => $outlay]);

// график баланса
echo $this->render('_balance-chart', ['model' => $model , 'balance' => $balance]);

Pjax::end();
FilterAsset::register($this);

