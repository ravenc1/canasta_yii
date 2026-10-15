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
            [['logo'], 'required', 'on' => 'create'],
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