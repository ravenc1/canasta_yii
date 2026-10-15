<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\Jugador;
use app\models\Puntuacion;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ReportesController extends Controller
{
    /**
     * Lista general de jugadores agrupados por equipo.
     */
    public function actionGeneral()
    {
        $equipos = Equipo::find()->with(['jugadores'])->orderBy(['nombre' => SORT_ASC])->all();
        return $this->render('general', [
            'equipos' => $equipos,
        ]);
    }

    /**
     * Lista de jugadores por equipo (filtro), ordenados por apellidos.
     */
    public function actionPorEquipo($equipo_id = null)
    {
        $equipos = Equipo::find()->orderBy(['nombre' => SORT_ASC])->all();

        $jugadores = [];
        if ($equipo_id) {
            $jugadores = Jugador::find()
                ->where(['equipo_id' => $equipo_id])
                ->orderBy(['apellidos' => SORT_ASC])
                ->all();
        }

        return $this->render('por-equipo', [
            'equipos' => $equipos,
            'equipo_id' => $equipo_id,
            'jugadores' => $jugadores,
        ]);
    }

    /**
     * Máximos anotadores: suma acumulada de puntos por jugador, mayor a menor.
     */
    public function actionMaximosAnotadores()
    {
        $rows = (new Query())
            ->select([
                'jugador.id AS jugador_id',
                'jugador.nombres',
                'jugador.apellidos',
                'equipo.nombre AS equipo',
                'jugador.fotografia',
                'COALESCE(SUM(puntuacion.puntos),0) AS total_puntos',
            ])
            ->from('jugador')
            ->innerJoin('equipo', 'equipo.id = jugador.equipo_id')
            ->leftJoin('puntuacion', 'puntuacion.jugador_id = jugador.id')
            ->groupBy('jugador.id')
            ->orderBy(['total_puntos' => SORT_DESC])
            ->all();

        return $this->render('maximos-anotadores', [
            'rows' => $rows,
        ]);
    }

    /**
     * Ficha individual del jugador con historial de puntos por jornada.
     */
    public function actionPerfil($id, $from = null)
    {
        $model = Jugador::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('El jugador no existe.');
        }

        $historial = Puntuacion::find()
            ->where(['jugador_id' => $id])
            ->with('tipoTiro')
            ->orderBy(['jornada' => SORT_ASC, 'fecha_registro' => SORT_ASC])
            ->all();

        // resumen por jornada
        $porJornada = (new Query())
            ->select(['jornada', 'SUM(puntos) AS total'])
            ->from('puntuacion')
            ->where(['jugador_id' => $id])
            ->groupBy('jornada')
            ->orderBy(['jornada' => SORT_ASC])
            ->all();

        $total = (int) Puntuacion::find()->where(['jugador_id' => $id])->sum('puntos');

        return $this->render('perfil', [
            'model' => $model,
            'historial' => $historial,
            'porJornada' => $porJornada,
            'total' => $total,
            'from' => $from,
        ]);
    }
}