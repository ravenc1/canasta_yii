<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo ActiveRecord para la tabla "puntuacion".
 *
 * @property int $id
 * @property int $jugador_id
 * @property int $jornada
 * @property int $tipo_tiro_id
 * @property int $puntos
 * @property string|null $fecha_registro
 *
 * @property Jugador $jugador
 * @property TipoTiro $tipoTiro
 */
class Puntuacion extends ActiveRecord
{
    public static function tableName()
    {
        return 'puntuacion';
    }

    public function rules()
    {
        return [
            [['jugador_id', 'jornada', 'tipo_tiro_id'], 'required'],
            [['jugador_id', 'jornada', 'tipo_tiro_id', 'puntos'], 'integer'],
            [['puntos'], 'default', 'value' => function ($model) {
                $tiro = TipoTiro::findOne($model->tipo_tiro_id);
                return $tiro ? $tiro->valor : 0;
            }],
            [['fecha_registro'], 'safe'],
            [['jugador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::class, 'targetAttribute' => ['jugador_id' => 'id']],
            [['tipo_tiro_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoTiro::class, 'targetAttribute' => ['tipo_tiro_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jugador_id' => 'Jugador',
            'jornada' => 'Jornada',
            'tipo_tiro_id' => 'Tipo de Tiro',
            'puntos' => 'Puntos',
            'fecha_registro' => 'Fecha de Registro',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert && empty($this->fecha_registro)) {
                $this->fecha_registro = date('Y-m-d H:i:s');
            }
            // Calcula puntos automáticamente según el tipo de tiro si no se indicó
            if (empty($this->puntos)) {
                $tiro = $this->tipoTiro;
                if ($tiro) {
                    $this->puntos = $tiro->valor;
                }
            }
            return true;
        }
        return false;
    }

    public function getJugador()
    {
        return $this->hasOne(Jugador::class, ['id' => 'jugador_id']);
    }

    public function getTipoTiro()
    {
        return $this->hasOne(TipoTiro::class, ['id' => 'tipo_tiro_id']);
    }
}