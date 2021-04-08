<?php


namespace app\models;


use Yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $bdate;
    public $edate;
    public $category;
    public $object;
    public $currency;
    public $type;

    public function rules() : array
    {
        return [

            [ ['category', 'object', 'currencies', 'bdate', 'edate'], 'safe' ],


        ];
    }
    public function attributeLabels() : array
    {
        return [
            'interval' => Yii::t('app', 'interval'),
            'category' => Yii::t('app', 'category'),
            'object' => Yii::t('app', 'object'),
            'currencies' => Yii::t('app', 'currencies'),

        ];
    }

}