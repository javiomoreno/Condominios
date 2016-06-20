<?php

use yii\helpers\Html;
use app\models\Usuarios;

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
