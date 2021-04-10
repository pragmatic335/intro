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
                'title' => ['text' => 'test'],
                'xAxis' => [
//                'type' => 'date',
                    'categories' => $income->categories

                ],
                'yAxis' => [
                    'title' => ['text' => 'Доход $']
                ],
                'tooltip' => ['valueSuffix' => '$'],
                'series' => [
                    ['name' => 'Доход', 'data' => $income->data],
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-6">
        <?php

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'test'],
                'xAxis' => [
//                'type' => 'date',
                    'categories' => $outlay->categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'Расход $']
                ],
                'tooltip' => ['valueSuffix' => '$'],
                'series' => [
                    ['name' => 'Доход', 'data' => $outlay->data],
                ]
            ]
        ]);
        ?>
    </div>
</div>
