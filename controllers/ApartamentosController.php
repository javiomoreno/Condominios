<?php

namespace app\controllers;

use Yii;
use app\models\Apartamentos;
use app\models\UsuarioApartamentos;
use app\models\search\ApartamentosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ApartamentosController implements the CRUD actions for Apartamentos model.
 */
class ApartamentosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['administrador'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Apartamentos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="main-admin";
        $model = Apartamentos::find()->all();
        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays a single Apartamentos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout ="main-admin";
        $model2 = UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id), 'model2' => $model2,
        ]);
    }

    /**
     * Creates a new Apartamentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout ="main-admin";
        $model = new Apartamentos();
        $model2 = new UsuarioApartamentos();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
          if ($model->save()) {
            $model2->apartamentos_id_apartamento = $model->id_apartamento;
            $model2->save();
            return $this->redirect(['view', 'id' => $model->id_apartamento]);
          }
        } else {
            return $this->render('create', [
                'model' => $model, 'model2' => $model2,
            ]);
        }
    }

    /**
     * Updates an existing Apartamentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout ="main-admin";
        $model2 = UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_apartamento]);
        } else {
            return $this->render('update', [
                'model' => $model, 'model2' => $model2,
            ]);
        }
    }

    /**
     * Deletes an existing Apartamentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apartamentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apartamentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apartamentos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
