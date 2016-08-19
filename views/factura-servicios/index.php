<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facturas de Servicios';
?>
<div class="usuarios-index">
    <p>
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-file']).' Nueva Factura de Servicios', ['create'], ['class' => 'btn btn-info'] );?>
    </p>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="box-body">
            <table id="dataTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Código</th>
                <th>Fecha</th>
                <th>Apartamento</th>
                <th>Propietio / Inquilino</th>
                <th>Iva</th>
                <th>Total</th>
                <th>Estado de Factura</th>
                <th style="text-align: center;">Opciones</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($model as $value): ?>
                  <tr class="odd gradeX">
                      <td><?= $value->id_factura_servicios;?></td>
                      <td><?= $value->fecha_factura;?></td>
                      <td><?= $value->apartamentosIdApartamento->ubicacion;?></td>
                      <td>
                        <?php if ($value->apartamentosIdApartamento->usuarios_id_usuario_in) {
                          echo $value->apartamentosIdApartamento->usuariosIdUsuarioIn->nombre;
                        }else{
                          echo $value->getPropietarioPrincipal($value->apartamentos_id_apartamento)->usuariosIdUsuarioPp->nombre;
                        }?>
                      </td>
                      <td><?= $value->iva;?></td>
                      <td><?= $value->total;?></td>
                      <td><?php if ($value->estado == 1) {echo "Sin Cancelar";} else {echo "Cancelada";};?></td>
                      <td style="text-align: center;">
                        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open green', 'style' => 'cursor: pointer']).'', ['factura-servicios/view?id='.$value->id_factura_servicios], ['title' => 'Ver Factura de Servicios'] );?>
                        <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-print', 'style' => 'cursor: pointer']).'', ['/factura-servicios/view-imprimir?id='.$value->id_factura_servicios], ['title' => 'Imprimir Factura de Servicios',  'target' => '_blank'] );?>
                      </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
  $(function () {
    $('#dataTable').DataTable({
      responsive: true,
      "aoColumns": [
        { "bSortable": true },
        null, null, null, null, null, null,
        { "bSortable": false }
      ],
      "language": {
        "lengthMenu": "_MENU_ Registros por pantalla",
        "zeroRecords": "No Hay Datos - Disculpe",
        "info": "Vista página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst":    "First",
            "sLast":     "Last",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
    });
  });
</script>
