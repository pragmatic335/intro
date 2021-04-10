<?php
/**
 * @var $model app\models\FilterForm
 * @var $income app\models\Income
 * @var $outlay app\models\Outlay
 */
?>

<div class="row">
    <div class="col-lg-6">
        <?php

        use miloschuman\highcharts\Highcharts;

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => Yii::t('app', 'Income')],
                'xAxis' => [
                    'categories' => $income->categories

                ],
                'yAxis' => [
                    'title' => ['text' => $income->cur]
                ],
                'series' => [
                    ['name' => Yii::t('app', 'Income'), 'data' => $income->data],
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-6">
        <?php

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => Yii::t('app', 'Outlay')],
                'xAxis' => [
                    'categories' => $outlay->categories
                ],
                'yAxis' => [
                    'title' => ['text' => $outlay->cur]
                ],
//                'tooltip' => ['valueSuffix' => '$'],
                'series' => [
                    ['name' => Yii::t('app', 'Outlay'), 'data' => $outlay->data],
                ]
            ]
        ]);
        ?>
    </div>
</div>
