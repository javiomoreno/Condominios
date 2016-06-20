<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

  <div class="row">
    <div class="col-xs-12">
      <?php $form = ActiveForm::begin(); ?>
        <div class="box">
          <div class="box-header">
            <p class="obligatorios">
              Los campos con * son obligatorios
            </p>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'tipoUsuarios_id_tipoUsuario')->dropDownList($model->listaTipoUsuarios, ['prompt' => 'Seleccione Tipo de Usuario' ])->label('Tipo de Usuario <span class="asterisco">*</span>');?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])->label('Nombre de Usuario <span class="asterisco">*</span>') ?>
              </div>
              <div class="col-xs-6">
                <?= $form->field($model, 'apellido')->textInput(['maxlength' => true])->label('Apellido de Usuario <span class="asterisco">*</span>') ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'cedula')->textInput(['maxlength' => true])->label('Cédula del Usuario <span class="asterisco">*</span>') ?>
              </div>
              <div class="col-xs-6">
                <?= $form->field($model, 'rif')->textInput(['maxlength' => true])->label('Rif de Usuario <span class="asterisco">*</span>') ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'correo')->textInput(['maxlength' => true])->label('Correo del Usuario <span class="asterisco">*</span>') ?>
              </div>
              <div class="col-xs-6">
                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label('Teléfono de Usuario <span class="asterisco">*</span>') ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'usuario')->textInput(['maxlength' => true])->label('Usuario de Acceso <span class="asterisco">*</span>') ?>
              </div>
              <div class="col-xs-6">
                <?= $form->field($model, 'clave')->passwordInput(['maxlength' => true])->label('Clave de Acceso <span class="asterisco">*</span>') ?>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            </div>
          </div>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
