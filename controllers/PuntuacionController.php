<?php

namespace app\controllers;

use Yii;
use app\models\Puntuacion;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PuntuacionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Puntuacion::find()->with(['jugador', 'tipoTiro'])->orderBy(['fecha_registro' => SORT_DESC]),
            'pagination' => ['pageSize' => 30],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Puntuacion();

        if ($model->load(Yii::$app->request->post())) {
            // Pre-asigna puntos según tipo de tiro si no se envió
            if (empty($model->puntos)) {
                $tiro = \app\models\TipoTiro::findOne($model->tipo_tiro_id);
                if ($tiro) {
                    $model->puntos = $tiro->valor;
                }
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Puntuacion::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('El registro no existe.');
    }
}