<?php
/**
 * @var $balance app\models\Balance
 */

use miloschuman\highcharts\Highcharts;
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'test'],
                'xAxis' => [
                    'categories' => $balance->categories
                ],
                'yAxis' => [
                    'title' => ['text' => Yii::t('app', $balance->cur)]
                ],
//                'tooltip' => ['valueSuffix' => '$'],
                'series' => [
                    ['name' => Yii::t('app', 'Balance'), 'data' => $balance->data],
                ]
            ]
        ]);
        ?>
    </div>
</div>
