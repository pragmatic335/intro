<?php


namespace app\controllers;


use app\models\Balance;
use app\models\FilterForm;
use app\models\Income;
use app\models\Outlay;
use Yii;
use yii\web\Controller;

class StatisticsController extends Controller
{
    public function actionIndex(): string
    {
        $model = new FilterForm();
        $income = new Income($model);
        $outlay = new Outlay($model);
        $balance = new Balance($model);


        if(Yii::$app->request->isAjax) {
            $model->attributes = $_POST['FilterForm'];
        }

        //параметры под доходную составляющую
        $income->setParams();

        //параметры под расходную
        $outlay->setParams();

        //параметры под балансную
        $balance->setParams();

        return $this->render('index',
            [
                'model' => $model,
                'income' => $income,
                'outlay' => $outlay,
                'balance' => $balance,
            ]);
    }
}