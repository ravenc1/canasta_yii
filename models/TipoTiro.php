<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo ActiveRecord para la tabla "tipo_tiro" (catálogo).
 *
 * @property int $id
 * @property string $nombre
 * @property int $valor
 */
class TipoTiro extends ActiveRecord
{
    public static function tableName()
    {
        return 'tipo_tiro';
    }

    public function rules()
    {
        return [
            [['nombre', 'valor'], 'required'],
            [['nombre'], 'string', 'max' => 50],
            [['valor'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Tipo de Tiro',
            'valor' => 'Valor en Puntos',
        ];
    }
}