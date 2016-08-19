<?php

use yii\helpers\Html;
use app\models\Usuarios;
use yii\bootstrap\Modal;

$this->title = 'Dashboard';
$usuario =  Usuarios::findIdentity(\Yii::$app->user->getId());
?>
<div class="jumbotron">
<h1>Administrador</h1>
<p>
  Bienvenido
</p>
<div class="row">
  <div class="col-lg-1">
  </div>
  <div class="col-lg-2 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-home fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="titulo-categoria">Apartamentos</div>
                  </div>
              </div>
          </div>
          <div class="panel-footer">
          </div>
      </div>
  </div>
  <div class="col-lg-2 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-users fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="titulo-categoria">Usuarios</div>
                  </div>
              </div>
          </div>
          <div class="panel-footer">
          </div>
      </div>
  </div>
  <div class="col-lg-2 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-sitemap fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="titulo-categoria">Servicios</div>
                  </div>
              </div>
          </div>
          <div class="panel-footer">
          </div>
      </div>
  </div>
  <div class="col-lg-2 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-check-square fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="titulo-categoria">Items</div>
                  </div>
              </div>
          </div>
          <div class="panel-footer">
          </div>
      </div>
  </div>
  <div class="col-lg-2 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-file-text fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="titulo-categoria">Facturas</div>
                  </div>
              </div>
          </div>
          <div class="panel-footer">
          </div>
      </div>
  </div>
  <div class="col-lg-1">
  </div>
</div>

<?php
  Modal::begin([
      'header' => '<h2>Duplicar Solicitud</h2>',
      'id' => 'modal-duplicar',
      'size' => 'modal-md',
      'footer' => ''.Html::button('Cancelar', ['class' => 'btn btn-sm btn-warning', 'data-dismiss'=>'modal']). Html::a('Aceptar', [''], ['class' => 'btn btn-sm btn-success']),]);

  echo "¿Seguro desea duplicar la solicitud?";

  Modal::end();
?>
<?php
  $this->registerJs("
    $(document).on('click', '.showModalButton', function(){
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
        } else {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
        }
    });
    $(document).on('click', '.showModalDuplicarButton', function(){
        if ($('#modal-duplicar').data('bs.modal').isShown) {
            $('#modal-duplicar').find('#modalContent')
                    .load($(this).attr('value'));
        } else {
            $('#modal-duplicar').modal('show')
                    .find('#modalDuplicarContent')
                    .load($(this).attr('value'));
        }
    });
    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});
  ");
?>
