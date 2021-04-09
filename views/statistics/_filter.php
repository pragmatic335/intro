<div class="row">
    <div class="col-lg-12">
        <div class="ibox collapsed border-bottom">
            <div class="ibox-title">
                <h5>Фильтр</h5>
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

                /** @var FilterForm $model */

                use app\models\FilterForm;
                use kartik\date\DatePicker;
                use kartik\depdrop\DepDrop;
                use kartik\select2\Select2;
                use yii\bootstrap\ActiveForm;
                use yii\helpers\Url;
                use yii\web\JsExpression;
                use yii\helpers\Html;

                $form = ActiveForm::begin([
                    'id' => 'filter-form',
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


                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="btn-group">
                            <?= Html::Button('Фильтр',
                                [
                                    'id' => 'submit-filter',
                                    'class' => 'btn btn-info',
//                                    'title' => Yii::t('app', 'Search')
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

