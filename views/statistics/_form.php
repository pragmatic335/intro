<?php

/** @var FilterForm $model */

use app\models\FilterForm;
use app\models\pdata\form\FlatFilterForm;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\Html;




$form = ActiveForm::begin([
    'id' => 'filter-form',
//    'enableClientValidation' => false,
//    'layout' => 'horizontal',
//    'fieldConfig' => [
//        'template' => "{label}{beginWrapper}{input}\n{error}{endWrapper}",
//        'horizontalCssClasses' => [
//            'label' => 'col-sm-3',
//            'offset' => false,
//            'wrapper' => 'col-sm-9',
//            'error' => '',
//
//        ],
//    ],
]);
?>
<div class="row">
    <div class="col-md-3">
        <?php
        echo $form->field($model, 'bdate')
            ->label(false)
            ->widget(DatePicker::classname(), [
                'model' => $model,
                'attribute' => 'bdate',
                'type' =>  2,
                'options' => ['placeholder' => 'Начало периода'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd.mm.yyyy',

                ],
            ]);

        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo $form->field($model, 'edate')
            ->label(false)
            ->widget(DatePicker::classname(), [
                'model' => $model,
                'attribute' => 'edate',
                'type' =>  3,
                'options' => ['placeholder' => 'Конец периода'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd.mm.yyyy',

                ],
            ]);

        ?>
    </div>

    <div class="col-md-3">
        <?php
        echo $form->field($model, 'type')
            ->label(false)
            ->widget(Select2::className(), [
                'name' => 'type',
                'options' => [
                    'placeholder' =>'Тип',
                    'multiple' => false,
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'placement' => 'bottom',
                        'url' =>   Url::to(['/'.\Yii::$app->controller->id.'/ajax/lists/types']),
                        'dataType' => 'json',
                        'data' =>  new JsExpression('function(params) { return {q:params.term}}'),
                    ],

                ],
            ]);
        ?>
    </div>

    <div class="col-md-3">
        <?php
        echo $form->field($model, 'currency')
            ->label(false)
            ->widget(Select2::className(), [
                'name' => 'currency',
                'options' => [
                    'placeholder' =>'Валюта',
                    'multiple' => false,
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'placement' => 'bottom',
                        'url' =>   Url::to(['/'.\Yii::$app->controller->id.'/ajax/lists/currencies']),
                        'dataType' => 'json',
                        'data' =>  new JsExpression('function(params) { return {q:params.term}}'),
                    ],

                ],
            ]);
        ?>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <?php
        echo $form->field($model, 'category')
            ->label(false)
            ->widget(Select2::className(), [
                'name' => 'category',
                'options' => [
                    'placeholder' =>'Категория',
                    'multiple' => false,
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'placement' => 'bottom',
                        'url' =>   Url::to(['/'.\Yii::$app->controller->id.'/ajax/lists/categories']),
                        'dataType' => 'json',
                        'data' =>  new JsExpression('function(params) { return {q:params.term}}'),
                    ],

                ],
            ]);
        ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'object')
            ->label(false)
            ->widget(DepDrop::classname(), [
                'options' => ['placeholder' => 'Объект'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['filterform-category'],
                    'url' =>  Url::to(['/'.\Yii::$app->controller->id.'/ajax/lists/objects']),
                    'loadingText' => '',
                ]
            ]); ?>
    </div>


    <div class="col-md-4">
        <?php

//        echo $form->field($filter, 'sex', ['horizontalCssClasses' => [
//            'wrapper' => 'col-sm-6',
//        ]])
//            ->label('Пол' . ':', ['class' => 'mylabel-style col-sm-6', 'style' => 'text-align:right'])
//            ->widget(Select2::className(), [
//                'model' => $filter,
//
//                'data' => [1 => 'любой' , 'муж', 'жен' ],
//                'theme' => Select2::THEME_BOOTSTRAP,
//                'hideSearch' => true,
//                'options' => ['placeholder' => false]]);
//
//        ?>
    </div>

    <div class="col-md-2">

    </div>
</div>




<?php ActiveForm::end(); ?>
