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
        <?php else: ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  Facturas de Servicios
                </div>
                <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Código</th>
                      <th>Fecha</th>
                      <th>Iva</th>
                      <th>Total</th>
                      <th>Estado de Factura</th>
                      <th style="text-align: center;">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($model4 as $value): ?>
                        <tr class="odd gradeX">
                            <td><?= $value->id_factura_servicios;?></td>
                            <td><?= $value->fecha_factura;?></td>
                            <td><?= $value->iva;?></td>
                            <td><?= $value->total;?></td>
                            <td><?if ($value->estado == 1) {echo "Sin Cancelar";} else {echo "Cancelada";};?></td>
                            <td style="text-align: center;">
                              <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open green', 'style' => 'cursor: pointer']).'', ['factura-servicios/view?id='.$value->id_factura_servicios], ['title' => 'Ver Factura de Gastos'] );?>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  Facturas de Gastos
                </div>
                <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Código</th>
                      <th>Fecha</th>
                      <th>Iva</th>
                      <th>Total</th>
                      <th>Estado de Factura</th>
                      <th style="text-align: center;">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($model3 as $value): ?>
                        <tr class="odd gradeX">
                            <td><?= $value->id_factura_gastos;?></td>
                            <td><?= $value->fecha_registro;?></td>
                            <td><?= $value->iva;?></td>
                            <td><?= $value->total;?></td>
                            <td><?if ($value->estado == 1) {echo "Sin Cancelar";} else {echo "Cancelada";};?></td>
                            <td style="text-align: center;">
                              <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open green', 'style' => 'cursor: pointer']).'', ['factura-gastos/view?id='.$value->id_factura_gastos], ['title' => 'Ver Factura de Gastos'] );?>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</div>
