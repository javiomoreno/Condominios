<?php

namespace app\controllers;

use Yii;
use app\models\Apartamentos;
use app\models\Usuarios;
use app\models\UsuarioApartamentos;
use app\models\FacturaGastos;
use app\models\FacturaServicios;
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
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['administrador'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['usuario'],
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
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-home';
        Yii::$app->view->params['tituloAdministrador'] = 'Apartamentos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Apartamentos';
        Yii::$app->view->params['subTitulo2Administrador'] = '';
        if (\Yii::$app->user->can('administrador')) {
          $this->layout ="main-admin";
          $model = Apartamentos::find()->all();
        }
        else if (\Yii::$app->user->can('usuario')){
          $this->layout ="main-usuario";
          $model1 = Usuarios::findIdentity(\Yii::$app->user->getId());
          if($model1->condicionUsuariosIdCondicionUsuario->id_condicionUsuario == 1){
            $sql = "SELECT * FROM apartamentos WHERE id_apartamento IN (SELECT apartamentos_id_apartamento FROM usuario_apartamentos WHERE usuarios_id_usuario_pp = $model1->id_usuario) ORDER BY id_apartamento DESC";
            $model = Apartamentos::findBySql($sql)->all();
          }
          else if($model1->condicionUsuariosIdCondicionUsuario->id_condicionUsuario == 2){
            $sql = "SELECT * FROM apartamentos WHERE id_apartamento IN (SELECT apartamentos_id_apartamento FROM usuario_apartamentos WHERE usuarios_id_usuario_ps = $model1->id_usuario) ORDER BY id_apartamento DESC";
            $model = Apartamentos::findBySql($sql)->all();
          }
          else if ($model1->condicionUsuariosIdCondicionUsuario->id_condicionUsuario == 3) {
            $model = Apartamentos::find()->where(['usuarios_id_usuario_in' => \Yii::$app->user->getId()])->all();
          }
        }
        return $this->render('index', ['model' => $model,]);
    }

    /**
     * Displays a single Apartamentos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-home';
        Yii::$app->view->params['tituloAdministrador'] = 'Apartamentos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Apartamentos';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Detalle de Apartamento';
        Yii::$app->view->params['linkAdministrador'] = 'index';
        if (\Yii::$app->user->can('administrador')) {
          $this->layout ="main-admin";
        }
        else if (\Yii::$app->user->can('usuario')){
          $this->layout ="main-usuario";
        }
        $model2 = UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
        $model3 = FacturaGastos::find()->where(['apartamentos_id_apartamento' => $id])->all();
        $model4 = FacturaServicios::find()->where(['apartamentos_id_apartamento' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id), 'model2' => $model2, 'model3' => $model3, 'model4' => $model4,
        ]);
    }

    /**
     * Creates a new Apartamentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-home';
        Yii::$app->view->params['tituloAdministrador'] = 'Apartamentos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Apartamentos';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Nuevo Apartamento';
        Yii::$app->view->params['linkAdministrador'] = 'index';
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
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-home';
        Yii::$app->view->params['tituloAdministrador'] = 'Apartamentos';
        Yii::$app->view->params['subTituloAdministrador'] = 'Lista de Apartamentos';
        Yii::$app->view->params['subTitulo2Administrador'] = 'Modificar Apartamento';
        Yii::$app->view->params['linkAdministrador'] = 'index';
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
