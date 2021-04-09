<?php


namespace app\controllers;


use app\models\FilterForm;
use app\models\Income;
use Yii;
use yii\web\Controller;

class StatisticsController extends Controller
{
    public function actionIndex(): string
    {
        $model = new FilterForm();

        if(Yii::$app->request->isAjax) {
            $model->load( \Yii::$app->request->get());
            $income = new Income($model);
            $test = $income->getIncome();
        }
        return $this->render('index', ['model' => $model]);
    }
}