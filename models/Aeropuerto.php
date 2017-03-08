<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aeropuertos".
 *
 * @property integer $id
 * @property string $id_aero
 * @property string $den_aero
 *
 * @property Vuelos[] $vuelos
 * @property Vuelos[] $vuelos0
 */
class Aeropuerto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aeropuertos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['den_aero'], 'required'],
            [['id_aero'], 'string', 'max' => 3],
            [['den_aero'], 'string', 'max' => 40],
            [['id_aero'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aero' => 'Id Aero',
            'den_aero' => 'Den Aero',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsOrigenDe()
    {
        return $this->hasMany(Vuelo::className(), ['orig_id' => 'id'])->inverseOf('origen');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsDestinoDe()
    {
        return $this->hasMany(Vuelo::className(), ['dest_id' => 'id'])->inverseOf('destino');
    }
}
