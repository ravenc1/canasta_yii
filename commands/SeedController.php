<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Equipo;
use app\models\Jugador;
use app\models\TipoTiro;
use app\models\Puntuacion;

/**
 * Comando para poblar la base de datos con datos demostrativos.
 * Uso: php yii seed
 */
class SeedController extends Controller
{
    public function actionIndex()
    {
        $this->stdout("Sembrando datos de La Canasta...\n");

        // Tipo de tiro
        if (TipoTiro::find()->count() == 0) {
            foreach ([
                ['Libre', 1],
                ['Dos puntos', 2],
                ['Tres puntos', 3],
            ] as $t) {
                $m = new TipoTiro(['nombre' => $t[0], 'valor' => $t[1]]);
                $m->save(false);
            }
        }

        $this->stdout("Listo.\n");
        return 0;
    }
}