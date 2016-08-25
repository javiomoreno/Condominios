<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = "Detalle de Servicio";
if ($model->todos == 1) {
  $propietario = "";
  $apartamento = "todos";
}
else {
  if ($model->apartamentosIdApartamento->usuarios_id_usuario_in) {
    $propietario = $model->apartamentosIdApartamento->usuariosIdUsuarioIn->nombre;
  }else{
    $propietario = $model->apartamentosIdApartamento->usuariosIdUsuarioPr->nombre;
  }
}

if ($model->estado == 1) {
  $estado = "Sin Cancelar";
} else {
  $estado = "Cancelada";
};
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
              'id_factura_servicios',
              'fecha_factura',
              [
                  'label' =>'Apartamento',
                  'value' => $apartamento,
              ],
              [
                  'label' =>'Propietario / Inquilino',
                  'value' => $propietario,
              ],
              'iva',
              'total',
              [
                  'label' =>'Estado de Factura',
                  'value' => $estado,
              ],
            ],
            ]) ?>
          </div>
          <div class="box-header">
            Servicios
          </div>
          <div class="box-body">
            <table id="dataTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Código</th>
                <th>Nombre de Servicio</th>
                <th>Descripción de Servicio</th>
                <th>Precio de Servicio</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($model2 as $value): ?>
                  <tr class="odd gradeX">
                      <td><?= $value->serviciosIdServicio->id_servicio;?></td>
                      <td><?= $value->serviciosIdServicio->nombre;?></td>
                      <td><?= $value->serviciosIdServicio->descripcion;?></td>
                      <td><?= $value->serviciosIdServicio->precio;?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <?php if (\Yii::$app->user->can('administrador')): ?>
          <div class="row">
              <div class="col-lg-12" style="text-align: center;">
                <p>
                  <?= Html::a('Imprimir', ['view-imprimir', 'id' => $model->id_factura_servicios], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
                </p>
              </div>
          </div>
        <?php elseif(\Yii::$app->user->can('usuario') && $model->estado == 1): ?>
          <div class="row">
            <div class="col-lg-12" style="text-align: center;">
              <p>
                <?= Html::a('Pagar Factura', ['pagar-factura', 'id' => $model->id_factura_servicios], ['class' => 'btn btn-primary',]) ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</div>
