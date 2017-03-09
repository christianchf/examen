<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $vuelo_id
 * @property string $asiento
 * @property string $fecha_hora
 *
 * @property Usuarios $usuario
 * @property Vuelos $vuelo
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'vuelo_id', 'asiento'], 'required'],
            [['usuario_id', 'vuelo_id'], 'integer'],
            [['asiento'], 'number'],
            [['fecha_hora'], 'safe'],
            [['vuelo_id', 'asiento'], 'unique', 'targetAttribute' => ['vuelo_id', 'asiento'], 'message' => 'Ese asiento ya esta ocupado.'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['vuelo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vuelo::className(), 'targetAttribute' => ['vuelo_id' => 'id']],
            [['asiento'], function ($attribute, $params, $validator) {
                $asiento = $this->asiento;
                $plazas = $this->vuelo->plazas;
                if ($asiento < 0 || $asiento > $plazas) {
                    $this->addError($attribute, "El asiento $asiento debe estar comprendido entre 1 y $plazas");
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'vuelo_id' => 'Vuelo ID',
            'asiento' => 'Asiento',
            'fecha_hora' => 'Fecha Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id'])->inverseOf('reservas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVuelo()
    {
        return $this->hasOne(Vuelo::className(), ['id' => 'vuelo_id'])->inverseOf('reservas');
    }
}
