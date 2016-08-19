<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = "Detalle de Item";
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
<style media="screen">
body {
  color: #000;
  font-family: Verdana, Geneva, sans-serif;
  font-size: 13px;
  font-style: normal;
  font-variant: normal;
  font-weight: 400;
  line-height: 18.5714px;
}

#breadcrumbs, a, #boton{
  display: none !important;
}

.wrap > .container {
  margin-top: 0px !important;
  padding-top: 0px !important;
}

.box{
  border-top: 3px solid #fff !important;
}

.footer{
  background-color: #fff;
   border-top: 1px solid #fff;
}

</style>
<div class="row cuerpo">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header" style="text-align:center">
        <h2>Descripción de Factura</h2>
        <h3>Factura de Gastos</h3><br><br>
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
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
            <p>
              <?= Html::a('Imprimir', ['update', 'id' => $model->id_factura_gastos], ['class' => 'btn btn-primary']) ?>
            </p>
          </div>
        </div>
      </div>
  </div>
</div>
