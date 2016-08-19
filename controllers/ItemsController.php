<?php

namespace app\controllers;

use Yii;
use app\models\Items;
use app\models\search\ItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\BaseJson;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-check-square';
        Yii::$app->view->params['tituloAdministrador'] = 'Items';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Items';
        Yii::$app->view->params['subTitulo2Administrador'] = '';
        Yii::$app->view->params['linkAdministrador'] = '';
        $model = Items::find()->all();
        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-check-square';
        Yii::$app->view->params['tituloAdministrador'] = 'Items';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Items';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Detalle de Item';
        Yii::$app->view->params['linkAdministrador'] = 'index';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-check-square';
        Yii::$app->view->params['tituloAdministrador'] = 'Items';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Items';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Nuevo Item';
        Yii::$app->view->params['linkAdministrador'] = 'index';
        $model = new Items();

        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_registro = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_item]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-check-square';
        Yii::$app->view->params['tituloAdministrador'] = 'Items';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Items';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Modificar Item';
        Yii::$app->view->params['linkAdministrador'] = 'index';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_item]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
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
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrecio($id){
      $opciones2 = Items::find()->where(['id_item'=>$id])->one();
      $item = array(
          "precio" => $opciones2->precio,
      );
      print_r(json_encode($item));
    }
}
