<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "charges".
 *
 * @property int $id
 * @property int|null $type_id
 * @property int $object_id
 * @property int|null $currency_id
 * @property float $sum
 * @property string $createdate
 * @property string|null $note
 *
 * @property ChargeTypes $type
 * @property Currencies $currency
 * @property Objects $object
 */
class Charges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'charges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'object_id', 'currency_id'], 'default', 'value' => null],
            [['type_id', 'object_id', 'currency_id'], 'integer'],
            [['object_id', 'sum', 'createdate'], 'required'],
            [['sum'], 'number'],
            [['createdate'], 'safe'],
            [['note'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChargeTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'sum' => Yii::t('app', 'Sum'),
            'createdate' => Yii::t('app', 'Createdate'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ChargeTypes::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currencies::className(), ['id' => 'currency_id']);
    }

    /**
     * Gets query for [[Object]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::className(), ['id' => 'object_id']);
    }
}
