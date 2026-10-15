<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Modelo ActiveRecord para la tabla "equipo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $logo
 * @property string|null $created_at
 *
 * @property Jugador[] $jugadores
 */
class Equipo extends ActiveRecord
{
    /** @var UploadedFile|null Archivo de logo subido desde el formulario */
    public $logoFile;

    public static function tableName()
    {
        return 'equipo';
    }

    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
            [['logo'], 'string', 'max' => 255],
            [['logoFile'], 'required', 'on' => 'create', 'message' => 'El logo no puede estar vacío.'],
            [['logoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, svg, webp', 'maxSize' => 2 * 1024 * 1024],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre del Equipo',
            'logo' => 'Logo',
            'logoFile' => 'Archivo de Logo',
            'created_at' => 'Fecha de Registro',
        ];
    }

    /**
     * Relación: un equipo tiene muchos jugadores.
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugador::class, ['equipo_id' => 'id']);
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
     * Establece la fecha de registro al crear un nuevo equipo.
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
     * Sube el archivo de logo y devuelve la ruta relativa a web/.
     */
    public function uploadLogo()
    {
        if ($this->logoFile instanceof UploadedFile) {
            $dir = Yii::getAlias('@webroot/uploads/logos/');
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $fileName = uniqid('logo_') . '.' . $this->logoFile->extension;
            $path = $dir . $fileName;
            if ($this->logoFile->saveAs($path)) {
                $this->logo = 'uploads/logos/' . $fileName;
                return true;
            }
        }
        return false;
    }
}