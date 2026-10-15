<?php

namespace app\controllers;

use Yii;
use app\models\Jugador;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class JugadorController extends Controller
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
            'query' => Jugador::find()->with('equipo'),
            'pagination' => ['pageSize' => 20],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Jugador();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $model->fotoFile = UploadedFile::getInstance($model, 'fotoFile');
            if ($model->validate()) {
                $ok = true;
                if ($model->fotoFile && !$model->uploadFoto()) {
                    $model->addError('fotoFile', 'No se pudo guardar el archivo de la fotografía.');
                    $ok = false;
                }
                if ($ok && $model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->fotoFile = UploadedFile::getInstance($model, 'fotoFile');
            if ($model->validate()) {
                $ok = true;
                if ($model->fotoFile && !$model->uploadFoto()) {
                    $model->addError('fotoFile', 'No se pudo guardar el archivo de la fotografía.');
                    $ok = false;
                }
                if ($ok && $model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \app\models\Jugador::renumberIds();
        \app\models\Puntuacion::renumberIds();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Jugador::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('El jugador no existe.');
    }
}