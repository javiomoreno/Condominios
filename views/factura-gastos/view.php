<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = "Detalle de Factura de Gastos";
if ($model->apartamentosIdApartamento->usuarios_id_usuario_in) {
  $propietari = $model->apartamentosIdApartamento->usuariosIdUsuarioIn->nombre;
}else{
  $propietario = $model->getPropietarioPrincipal($model->apartamentos_id_apartamento)->usuariosIdUsuarioPp->nombre;
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
              'id_factura_gastos',
              'fecha_registro',
              [
                  'label' =>'Apartamento',
                  'value' => $model->apartamentosIdApartamento->ubicacion,
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
            Items
          </div>
          <div class="box-body">
            <table id="dataTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Código</th>
                <th>Nombre de Item</th>
                <th>Descripción de Item</th>
                <th>Precio de Item</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($model2 as $value): ?>
                  <tr class="odd gradeX">
                      <td><?= $value->itemsIdItem->id_item;?></td>
                      <td><?= $value->itemsIdItem->nombre;?></td>
                      <td><?= $value->itemsIdItem->descripcion;?></td>
                      <td><?= $value->itemsIdItem->precio;?></td>
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
                <?= Html::a('Imprimir', ['view-imprimir', 'id' => $model->id_factura_gastos], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
              </p>
            </div>
          </div>
        <?php elseif(\Yii::$app->user->can('usuario') && $model->estado == 1): ?>
          <div class="row">
            <div class="col-lg-12" style="text-align: center;">
              <p>
                <?= Html::a('Pagar Factura', ['pagar-factura', 'id' => $model->id_factura_gastos], ['class' => 'btn btn-primary',]) ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</div>
