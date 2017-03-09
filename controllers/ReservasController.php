<?php

namespace app\controllers;

use Yii;
use app\models\Vuelo;
use app\models\Usuario;
use app\models\Reserva;
use app\models\ReservaSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservasController implements the CRUD actions for Reserva model.
 */
class ReservasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reserva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Reserva::find()->where(['usuario_id' => Yii::$app->user->id])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Reserva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrear($vuelo_id)
    {
        $model = new Reserva();
        $vuelo = Vuelo::findDisponibles()->where(['vuelos.id'=> $vuelo_id])->one();

        if ($vuelo == null) {
            throw new NotFoundHttpException('Vuelo inexistente');
        }

        $model->vuelo_id = $vuelo_id;
        $model->usuario_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('crear', [
                'model' => $model,
                'vuelo' => $vuelo->id_vuelo,
            ]);
        }
    }
}
