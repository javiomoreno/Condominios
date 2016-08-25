<?php

namespace app\controllers;

use Yii;
use app\models\FacturaGastos;
use app\models\FacturaGastosItems;
use app\models\Model;
use app\models\search\FacturaGastosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FacturaGastosController implements the CRUD actions for FacturaGastos model.
 */
class FacturaGastosController extends Controller
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
     * Lists all FacturaGastos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-file-text';
        Yii::$app->view->params['tituloAdministrador'] = 'Factura de Gastos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Factura de Gastos';
        Yii::$app->view->params['subTitulo2Administrador'] = '';
        Yii::$app->view->params['linkAdministrador'] = '';
        $model = FacturaGastos::find()->all();
        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays a single FacturaGastos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('administrador')) {
          $this->layout ="main-admin";
          Yii::$app->view->params['iconoAdministrador'] = 'fa fa-file-text';
          Yii::$app->view->params['tituloAdministrador'] = 'Factura de Gastos';
          Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Factura de Gastos';
          Yii::$app->view->params['subTitulo2Administrador'] = 'Detalle de Factura de Gastos';
          Yii::$app->view->params['linkAdministrador'] = 'index';
        }
        else if (\Yii::$app->user->can('usuario')){
          $this->layout ="main-usuario";
          Yii::$app->view->params['iconoAdministrador'] = 'fa fa-home';
          Yii::$app->view->params['tituloAdministrador'] = 'Apartamentos';
          Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Apartamentos';
          Yii::$app->view->params['subTitulo2Administrador'] = 'Detalle de Apartamento';
          Yii::$app->view->params['linkAdministrador'] = 'apartamentos/index';
        }
        $model2 = FacturaGastosItems::find()->where(['factura_gastos_id_factura_gastos' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id), 'model2' => $model2
        ]);
    }

    /**
     * Creates a new FacturaGastos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-file-text';
        Yii::$app->view->params['tituloAdministrador'] = 'Factura de Gastos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Factura de Gastos';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Nueva Factura de Gastos';
        Yii::$app->view->params['linkAdministrador'] = 'index';
        $model = new FacturaGastos;
        $modelItems = [new FacturaGastosItems];

        if ($model->load(Yii::$app->request->post())) {

            $modelItems = Model::createMultiple(FacturaGastosItems::classname());
            Model::loadMultiple($modelItems, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelItems) && $valid;

            if ($valid) {
                $model->estado = 1;
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelItems as $modelItem) {
                            $modelItem->factura_gastos_id_factura_gastos = $model->id_factura_gastos;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id_factura_gastos]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelItems' => (empty($modelItems)) ? [new Items] : $modelItems
        ]);
    }

    /**
     * Updates an existing FacturaGastos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout ="main-admin";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_factura_gastos]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FacturaGastos model.
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
     * Finds the FacturaGastos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FacturaGastos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FacturaGastos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionViewImprimir($id){
      $this->layout ="main-imprimir";
      $model2 = FacturaGastosItems::find()->where(['factura_gastos_id_factura_gastos' => $id])->all();
      return $this->render('view-imprimir', [
          'model' => $this->findModel($id), 'model2' => $model2
      ]);
    }

    public function actionPagarFactura($id){
        $model = $this->findModel($id);
        $model->estado = 2;
        $model->save();
        return $this->redirect(['view', 'id' => $model->id_factura_gastos]);
<<<<<<< HEAD
=======

>>>>>>> origin/master
    }
}
