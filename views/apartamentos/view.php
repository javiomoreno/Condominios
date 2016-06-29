<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = "Detalle de Apartamento";
if($model2->usuarios_id_usuario_ps != null){
  $ps = $model2->usuariosIdUsuarioPs->nombre;
}
else{
  $ps = "";
}
if($model->usuarios_id_usuario_in != null){
  $in = $model->usuariosIdUsuarioIn->nombre;
}
else{
  $in = "";
}
?>
<div class="usuarios-view">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
              'ubicacion',
              'observaciones',
              [                      // the owner name of the model
                'label' => 'Propietario Principal',
                'value' => $model2->usuariosIdUsuarioPp->nombre,
              ],
              [                      // the owner name of the model
                'label' => 'Propietario Secundario',
                'value' => $ps,
              ],
              [                      // the owner name of the model
                'label' => 'Inquilino',
                'value' => $in,
              ]
            ],
            ]) ?>
          </div>
        </div>
        <?php if (\Yii::$app->user->can('administrador')): ?>
          <div class="row">
            <div class="col-lg-12" style="text-align: center;">
              <p>
                <?= Html::a('Modificar', ['update', 'id' => $model->id_apartamento], ['class' => 'btn btn-primary']) ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</div>
