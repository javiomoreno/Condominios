<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apartamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">
  <?php if (\Yii::$app->user->can('administrador')): ?>
    <p>
      <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-file']).' Nuevo Apartamento', ['create'], ['class' => 'btn btn-info'] );?>
    </p>
  <?php endif; ?>
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
                <th>Obsevaciones</th>
                <th>Ubicación</th>
                <th>Propietario</th>
                <th>Inqulino</th>
                <th style="text-align: center;">Opciones</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($model as $value): ?>
                  <tr class="odd gradeX">
                      <td><?= $value->id_apartamento;?></td>
                      <td><?= $value->ubicacion;?></td>
                      <td><?= $value->observaciones;?></td>
                      <td><?php
                        if($value->usuarios_id_usuario_pr){
                          echo $value->usuariosIdUsuarioPr->nombre;
                        }else{
                          echo "";
                        }?>
                      </td>
                      <td><?php
                        if($value->usuarios_id_usuario_in){
                          echo $value->usuariosIdUsuarioIn->nombre;
                        }else{
                          echo "";
                        }?>
                      </td>
                      <td style="text-align: center;">
                        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open green', 'style' => 'cursor: pointer']).'', ['apartamentos/view?id='.$value->id_apartamento], '' );?>
                        <?php if (\Yii::$app->user->can('administrador')): ?>
                          <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil blue', 'style' => 'cursor: pointer']).'', ['/apartamentos/update?id='.$value->id_apartamento], '' );?>
                        <?php endif; ?>
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
        null, null, null, null,
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
