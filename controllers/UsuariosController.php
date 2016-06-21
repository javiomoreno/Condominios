<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuarioApartamentos;
use app\models\search\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\BaseJson;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout ="main-admin";
        $model = Usuarios::find()->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout ="main-admin";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout ="main-admin";
        $model = new Usuarios();

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->clave);
            if($model->save()){
              $auth = \Yii::$app->authManager;
              if ($model->tipoUsuarios_id_tipoUsuario == 1) {
                  $role = $auth->getRole('administrador');
                  $auth->assign($role, $model->getId());
              }
              else if ($model->tipoUsuarios_id_tipoUsuario == 2) {
                  $role = $auth->getRole('usuario');
                  $auth->assign($role, $model->getId());
              }
              return $this->redirect(['view', 'id' => $model->id_usuario]);
            }
            else {
              return $this->render('create', [
                  'model' => $model,
              ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout ="main-admin";
        $model = $this->findModel($id);

        $claveOld = $model->clave;
        if ($model->load(Yii::$app->request->post())) {
          if ($model->clave !== $claveOld) {
            $model->setPassword($model->clave);
          }
          $model->save();
          return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuarios model.
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
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPropietario($id){
      $opciones = UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
      $opciones2 = Usuarios::find()->where(['id_usuario'=>$opciones->usuarios_id_usuario_pp])->one();
      $propietario = array(
          "nombre" => $opciones2->nombre,
          "cedula" => $opciones2->cedula,
          "rif" => $opciones2->rif,
          "telefono" => $opciones2->telefono,
      );
      print_r(json_encode($propietario));
    }
}
