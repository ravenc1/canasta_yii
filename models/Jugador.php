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
            [['fotoFile'], 'required', 'on' => 'create', 'message' => 'La fotografía no puede estar vacía.'],
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
     * Renumerar los ID para que no queden huecos tras eliminar registros.
     */
    public static function renumberIds()
    {
        $db = static::getDb();
        $table = static::tableName();
        $transaction = $db->beginTransaction();
        try {
            $ids = static::find()->select('id')->orderBy(['id' => SORT_ASC])->column();
            $newId = 1;
            foreach ($ids as $oldId) {
                $oldId = (int) $oldId;
                if ($oldId !== $newId) {
                    static::updateAll(['id' => $newId], ['id' => $oldId]);
                }
                $newId++;
            }
            $next = count($ids) + 1;
            $db->createCommand('ALTER TABLE ' . $db->quoteTableName($table) . ' AUTO_INCREMENT = ' . $next)->execute();
            $transaction->commit();
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Total acumulado de puntos del jugador.
     */
    public function getTotalPuntos()
    {
        return (int) $this->hasMany(Puntuacion::class, ['jugador_id' => 'id'])->sum('puntos');
    }

    /**
     * Establece la fecha de registro al crear un nuevo jugador.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert && empty($this->created_at)) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
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