<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
?>
<div class="usuarios-index">
    <p>
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-file']).' Nuevo Item', ['create'], ['class' => 'btn btn-info'] );?>
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
                <th>Nombre de Item</th>
                <th>Descripción de Item</th>
                <th>Precio de Item</th>
                <th style="text-align: center;">Opciones</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($model as $value): ?>
                  <tr class="odd gradeX">
                      <td><?= $value->id_item;?></td>
                      <td><?= $value->nombre;?></td>
                      <td><?= $value->descripcion;?></td>
                      <td><?= $value->precio;?></td>
                      <td style="text-align: center;">
                        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open green', 'style' => 'cursor: pointer']).'', ['items/view?id='.$value->id_item], '' );?>
                        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil blue', 'style' => 'cursor: pointer']).'', ['/items/update?id='.$value->id_item], '' );?>
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
        null, null, null,
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
