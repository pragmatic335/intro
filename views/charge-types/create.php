<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeTypes */

$this->title = Yii::t('app', 'Create Charge Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Charge Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
