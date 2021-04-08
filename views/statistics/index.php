<div class="col-lg-12">
    <div class="ibox collapsed border-bottom">
        <div class="ibox-title">
            <h5>Example of initial collapsed panel</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-down"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" style="display: block;">

            <?php
            /**
             * @var $model app\models\FilterForm
             */


            echo $this->render( '_form', [
                'model' => $model,
            ] );


            ?>

        </div>
    </div>
</div>

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