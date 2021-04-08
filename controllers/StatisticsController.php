<?php


namespace app\controllers;


use app\models\FilterForm;
use yii\web\Controller;

class StatisticsController extends Controller
{
    public function actionIndex(): string
    {
        $model = new FilterForm();
        return $this->render('index', ['model' => $model]);
    }
}