<?php

namespace app\helpers;

use Yii;

class ImagenHelper
{
    /**
     * Devuelve una ruta usable por Html::img() a partir de una ruta relativa en web/.
     * Si el archivo no existe en disco, devuelve un placeholder para evitar imágenes rotas.
     */
    public static function src($ruta, $placeholder = 'uploads/placeholder.svg')
    {
        $ruta = trim((string)$ruta);
        if ($ruta !== '') {
            $relative = ltrim(str_replace('\\', '/', $ruta), '/');
            $fullPath = Yii::getAlias('@webroot') . '/' . $relative;
            if (is_file($fullPath)) {
                return '@web/' . $relative;
            }
        }
        return '@web/' . ltrim(str_replace('\\', '/', $placeholder), '/');
    }
}
