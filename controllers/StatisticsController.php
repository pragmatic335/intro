<?php


namespace app\controllers;


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

        if(Yii::$app->request->isAjax) {
            $model->attributes = $_POST['FilterForm'];
//            $income = new Income($model);
//            $outlay = new Outlay($model);

//            $model->load( $_POST['FilterForm']);
//            var_dump($model); die();
//            $income = new Income($model);
//            $test = $income->getIncome();

//            var_dump($income->filter); die();
        }

        $income->setParams();
        $outlay->setParams();
        return $this->render('index',
            [
                'model' => $model,
                'income' => $income,
                'outlay' => $outlay,

            ]);
    }
}