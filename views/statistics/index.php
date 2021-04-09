<?php
/**
 * @var $model app\models\FilterForm
 */

use app\assets\FilterAsset;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

echo $this->render('_filter', ['model' => $model]);

Pjax::begin(['id' => 'filter-pjax', 'enablePushState' => true, 'timeout' => false]);

echo $this->render('_filterhide', ['model' => $model]);
?>



<div class="row">
    <div class="col-lg-4">
        <div class="widget navy-bg no-padding">
            <div class="p-m">
                <h1 class="m-xs">$ 1,540</h1>

                <h3 class="font-bold no-margins">
                    Annual income
                </h3>
                <small>Income form project Alpha.</small>
            </div>
            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-chart1" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="widget lazur-bg no-padding">
            <div class="p-m">
                <h1 class="m-xs">$ 210,660</h1>

                <h3 class="font-bold no-margins">
                    Monthly income
                </h3>
                <small>Income form project Beta.</small>
            </div>
            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-chart2" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="widget yellow-bg no-padding">
            <div class="p-m">
                <h1 class="m-xs">$ 50,992</h1>

                <h3 class="font-bold no-margins">
                    Half-year revenue margin
                </h3>
                <small>Sales marketing.</small>
            </div>
            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-chart3" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas></div>
            </div>
        </div>
    </div>
</div>





<?php



echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'test'],
        'xAxis' => [
            'categories' => [
                Yii::$app->formatter->format('01.01.2020', 'date'),


            ]
        ],
        'yAxis' => [
            'title' => ['text' => 'up']
        ],
        'series' => [
            ['name' => 'Jane', 'data' => [1, 0, 4,]],
            ['name' => 'John', 'data' => [5, 7, 3]]
        ]
    ]
]);

Pjax::end();
FilterAsset::register($this);

?>