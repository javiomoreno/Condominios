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
                <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true])->label('Ubicación de Apartamento <span class="asterisco">*</span>') ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true])->label('Observaciones de Apartamento <span class="asterisco">*</span>') ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?= $form->field($model, 'usuarios_id_usuario_pr')->dropDownList($model->listaPropietarios, ['prompt' => 'Seleccione Propietario' ])->label('Propietario de Apartamento <span class="asterisco">*</span>');?>
              </div>
              <div class="col-xs-6">
                <?= $form->field($model, 'usuarios_id_usuario_in')->dropDownList($model->listaInquilinos, ['prompt' => 'Seleccione Inqilino' ])->label('Inquilino de Apartamento');?>
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
