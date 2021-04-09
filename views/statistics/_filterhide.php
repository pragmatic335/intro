<div class="hide">
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
    'id' => 'filter-hide-form',
    'method' => 'get',
    'options' => ['data-pjax' => true ]
]);


echo $form->field($model, 'bdate', [
    'inputOptions' => [
        'id' => 'filter-hide-form-bdate',
    ]]);

echo $form->field($model, 'edate', [
    'inputOptions' => [
        'id' => 'filter-hide-form-edate',
    ]]);

echo $form->field($model, 'type', [
    'inputOptions' => [
        'id' => 'filter-hide-form-type',
    ]]);

echo $form->field($model, 'currency', [
    'inputOptions' => [
        'id' => 'filter-hide-form-currency',
    ]]);

echo $form->field($model, 'category', [
    'inputOptions' => [
        'id' => 'filter-hide-form-category',
    ]]);

echo $form->field($model, 'object', [
    'inputOptions' => [
        'id' => 'filter-hide-form-object',
    ]]);

ActiveForm::end();

?>

</div>