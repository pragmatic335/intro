<?php
/**
 * @var $model app\models\FilterForm
 * @var $income app\models\Income
 * @var $outlay app\models\Outlay
 * @var $balance app\models\Balance
 */
?>

<div class="row">
    <div class="col-lg-4">
        <div class="widget navy-bg no-padding">
            <div class="p-m">
                <h1 class="m-xs">
                    <?php

                    if($model->currency == 1 || !$model->currency) {
                        echo '<i class="fa fa-ruble"></i>';
                    }

                    if($model->currency == 2) {
                        echo '<i class="fa fa fa-euro"></i>';
                    }

                    if($model->currency == 3) {
                        echo '<i class="fa fa-dollar"></i>';
                    }

                    echo " &nbsp; " . $income->summa;
                    ?>
                </h1>

                <h3 class="font-bold no-margins">
                    Доход
                </h3>
                <small>Income form project Alpha.</small>
            </div>
            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-chart1" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="widget red-bg no-padding">
            <div class="p-m">
                <h1 class="m-xs">
                    <?php

                    if($model->currency == 1 || !$model->currency) {
                        echo '<i class="fa fa-ruble"></i>';
                    }

                    if($model->currency == 2) {
                        echo '<i class="fa fa fa-euro"></i>';
                    }

                    if($model->currency == 3) {
                        echo '<i class="fa fa-dollar"></i>';
                    }

                    echo " &nbsp; " . $outlay->summa;
                    ?>
                </h1>

                <h3 class="font-bold no-margins">
                    Расход
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
                <h1 class="m-xs">
                    <?php

                    if($model->currency == 1 || !$model->currency) {
                        echo '<i class="fa fa-ruble"></i>';
                    }

                    if($model->currency == 2) {
                        echo '<i class="fa fa fa-euro"></i>';
                    }

                    if($model->currency == 3) {
                        echo '<i class="fa fa-dollar"></i>';
                    }

                    echo " &nbsp; ";
                    echo $balance->summa;
                    ?>
                </h1>

                <h3 class="font-bold no-margins">
                    Баланс
                </h3>
                <small>Sales marketing.</small>
            </div>
            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-chart3" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 684px; height: 100px;" width="684" height="100"></canvas></div>
            </div>
        </div>
    </div>
</div>
