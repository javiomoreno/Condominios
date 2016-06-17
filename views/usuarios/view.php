<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = "Detalle de Usuario";
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
              'tipoUsuarioIdTipoUsuario.nombre',
              'nombre',
              'apellido',
              'cedula',
              'rif',
              'correo',
              'telefono',
              'usuario',
              [                      // the owner name of the model
                'label' => 'Clave de Acceso',
                'value' => '*********',
              ],
            ],
            ]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
            <p>
              <?= Html::a('Modificar', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
            </p>
          </div>
        </div>
      </div>
  </div>
</div>
