<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companias".
 *
 * @property integer $id
 * @property string $den_comp
 *
 * @property Vuelos[] $vuelos
 */
class Compania extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['den_comp'], 'required'],
            [['den_comp'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'den_comp' => 'Den Comp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVuelos()
    {
        return $this->hasMany(Vuelo::className(), ['comp_id' => 'id'])->inverseOf('compania');
    }
}
