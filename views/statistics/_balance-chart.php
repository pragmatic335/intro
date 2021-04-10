<div class="row">
    <div class="col-lg-12">
        <?php

        use miloschuman\highcharts\Highcharts;

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'test'],
                'xAxis' => [
//                'type' => 'date',
                    'categories' => [

                        Yii::$app->formatter->format('01.01.2014', 'date'),
                        Yii::$app->formatter->format('01.01.2015', 'date'),
                        Yii::$app->formatter->format('01.01.2016', 'date'),
                        Yii::$app->formatter->format('01.01.2017', 'date'),
                        Yii::$app->formatter->format('01.01.2018', 'date'),
                        Yii::$app->formatter->format('01.01.2019', 'date'),
                        Yii::$app->formatter->format('01.01.2020', 'date'),
                        Yii::$app->formatter->format('01.02.2020', 'date'),
                        Yii::$app->formatter->format('01.03.2020', 'date'),
                        Yii::$app->formatter->format('01.04.2020', 'date'),
                        Yii::$app->formatter->format('01.05.2020', 'date'),
                        Yii::$app->formatter->format('01.06.2020', 'date'),
                        Yii::$app->formatter->format('01.07.2020', 'date'),
                        Yii::$app->formatter->format('01.08.2020', 'date'),
                        Yii::$app->formatter->format('01.09.2020', 'date'),
                        Yii::$app->formatter->format('01.10.2020', 'date'),
                        Yii::$app->formatter->format('01.11.2020', 'date'),
                        Yii::$app->formatter->format('01.12.2020', 'date'),
                        Yii::$app->formatter->format('01.01.2021', 'date'),
                        Yii::$app->formatter->format('01.02.2021', 'date'),
                        Yii::$app->formatter->format('01.03.2021', 'date'),
                        Yii::$app->formatter->format('01.04.2021', 'date'),

                    ]
                ],
                'yAxis' => [
                    'title' => ['text' => 'Доход $']
                ],
                'tooltip' => ['valueSuffix' => '$'],
                'series' => [
                    ['name' => 'Доход', 'data' => [1,123, -123.42]],
                ]
            ]
        ]);
        ?>
    </div>
</div>
