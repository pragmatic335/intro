<?php


namespace app\controllers;


use app\models\Categories;
use app\models\ChargeTypes;
use app\models\Currencies;
use app\models\Objects;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class AjaxController extends Controller
{
    public function actionAjax($mode = null, $submode = null)
    {

        if ($mode == "lists") {
            $method = '_ajax' . 'Get' . ucfirst($mode) . ucfirst($submode);
            if (method_exists($this, $method)) {
                return $this->$method();
            }
        }
        //на все левые обращения выдаем 404
        throw new HttpException(404);
    }

    public function _ajaxGetListsCategories()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $categories = Categories::find()->where(['like', 'name', $str])->asArray()->all();

            foreach ($categories as $category) {
                $result['results'][] = ['id' => $category['id'], 'text' => $category['name']];
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    public function _ajaxGetListsTypes()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $types = ChargeTypes::find()->where(['like', 'name', $str])->asArray()->all();

            foreach ($types as $type) {
                $result['results'][] = ['id' => $type['id'], 'text' => $type['name']];
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    public function _ajaxGetListsCurrencies()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $currencies = Currencies::find()->where(['like', 'name', $str])->asArray()->all();

            foreach ($currencies as $currency) {
                $result['results'][] = ['id' => $currency['id'], 'text' => $currency['name']];
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    public function _ajaxGetListsObjects()
    {
        $result = [];
        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $objects = Objects::find()->where( ['category_id' => $_POST['depdrop_parents'][0] ])->asArray()->all();
                foreach ($objects as $object) {
                    $result['output'][] = ['id' => $object['id'], 'name' => $object['name']];
                }
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

}