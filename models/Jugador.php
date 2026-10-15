<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Modelo ActiveRecord para la tabla "jugador".
 *
 * @property int $id
 * @property int $equipo_id
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $fotografia
 * @property string|null $created_at
 *
 * @property Equipo $equipo
 * @property Puntuacion[] $puntuaciones
 */
class Jugador extends ActiveRecord
{
    /** @var UploadedFile|null Fotografía subida desde el formulario */
    public $fotoFile;

    public static function tableName()
    {
        return 'jugador';
    }

    public function rules()
    {
        return [
            [['equipo_id', 'nombres', 'apellidos', 'fecha_nacimiento'], 'required'],
            [['equipo_id'], 'integer'],
            [['fecha_nacimiento'], 'date', 'format' => 'php:Y-m-d'],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['fotografia'], 'string', 'max' => 255],
            [['fotografia'], 'required', 'on' => 'create'],
            [['fotoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 2 * 1024 * 1024],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipo_id' => 'Equipo',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'fotografia' => 'Fotografía',
            'fotoFile' => 'Archivo de Fotografía',
            'created_at' => 'Fecha de Registro',
        ];
    }

    public function getEquipo()
    {
        return $this->hasOne(Equipo::class, ['id' => 'equipo_id']);
    }

    public function getPuntuaciones()
    {
        return $this->hasMany(Puntuacion::class, ['jugador_id' => 'id']);
    }

    /**
     * Total acumulado de puntos del jugador.
     */
    public function getTotalPuntos()
    {
        return (int) $this->hasMany(Puntuacion::class, ['jugador_id' => 'id'])->sum('puntos');
    }

    /**
     * Sube la fotografía y devuelve la ruta relativa.
     */
    public function uploadFoto()
    {
        if ($this->fotoFile instanceof UploadedFile) {
            $dir = Yii::getAlias('@webroot/uploads/fotos/');
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $fileName = uniqid('foto_') . '.' . $this->fotoFile->extension;
            $path = $dir . $fileName;
            if ($this->fotoFile->saveAs($path)) {
                $this->fotografia = 'uploads/fotos/' . $fileName;
                return true;
            }
        }
        return false;
    }
}