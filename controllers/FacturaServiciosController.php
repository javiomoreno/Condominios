<?php

namespace app\controllers;

use Yii;
use app\models\FacturaServicios;
use app\models\FacturaServiciosServicios;
use app\models\Model;
use app\models\search\FacturaServiciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FacturaServiciosController implements the CRUD actions for FacturaServicios model.
 */
class FacturaServiciosController extends Controller
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
     * Lists all FacturaServicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="main-admin";
        $model = FacturaServicios::find()->all();
        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays a single FacturaServicios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout ="main-admin";
        $model2 = FacturaServiciosServicios::find()->where(['factura_servicios_id_factura_servicios' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id), 'model2' => $model2
        ]);
    }

    /**
     * Creates a new FacturaServicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $this->layout ="main-admin";
      $model = new FacturaServicios;
      $modelServicios = [new FacturaServiciosServicios];

      if ($model->load(Yii::$app->request->post())) {

          $modelServicios = Model::createMultiple(FacturaServiciosServicios::classname());
          Model::loadMultiple($modelServicios, Yii::$app->request->post());

          // validate all models
          $valid = $model->validate();
          $valid = Model::validateMultiple($modelServicios) && $valid;

          if ($valid) {
            $model->estado = 1;
              $transaction = \Yii::$app->db->beginTransaction();
              try {
                  if ($flag = $model->save(false)) {
                      foreach ($modelServicios as $modelServicio) {
                          $modelServicio->factura_servicios_id_factura_servicios = $model->id_factura_servicios;
                          if (! ($flag = $modelServicio->save(false))) {
                              $transaction->rollBack();
                              break;
                          }
                      }
                  }
                  if ($flag) {
                      $transaction->commit();
                      return $this->redirect(['view', 'id' => $model->id_factura_servicios]);
                  }
              } catch (Exception $e) {
                  $transaction->rollBack();
              }
          }
      }

      return $this->render('create', [
          'model' => $model,
          'modelServicios' => (empty($modelServicios)) ? [new Items] : $modelServicios
      ]);
    }

    /**
     * Updates an existing FacturaServicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_factura_servicios]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FacturaServicios model.
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
     * Finds the FacturaServicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FacturaServicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FacturaServicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
