<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaGastos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-gastos-form">
  <div class="box">
    <div class="box-header">
      <p class="obligatorios">
        Los campos con * son obligatorios
      </p>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="row">
          <div class="col-lg-3">
            <?= $form->field($model, 'fecha_registro')->label('Fecha <span class="asterisco">*</span>')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]) ?>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <?= $form->field($model, "apartamentos_id_apartamento")->dropDownList($model->listaApartamentos, ['onchange'=>'cargarPropietario(this.value)', 'prompt' => 'Seleccione Apartamento' ]);?>
          </div>
        </div>

        <div class="col-lg-12 datos">
          <div class="row">
            <div class="col-lg-3">
              <label for="">Propietario / Inquilino</label>
              <input type="text" name="name" id="nombre" value="" class="form-control" disabled>
            </div>
            <div class="col-lg-3">
              <label for="">Cédula</label>
              <input type="text" name="name" id="cedula" value="" class="form-control" disabled>
            </div>
            <div class="col-lg-3">
              <label for="">Rif</label>
              <input type="text" name="name" id="rif" value="" class="form-control" disabled>
            </div>
            <div class="col-lg-3">
              <label for="">Teléfono</label>
              <input type="text" name="name" id="telefono" value="" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
          </div>
          <div class="col-lg-6">
            <div class="col-lg-6">
              <?= $form->field($model, 'iva')->textInput(['readonly' => true]) ?>
            </div>
            <div class="col-lg-6">
              <?= $form->field($model, 'total')->textInput(['readonly' => true]) ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
          </div>
        </div>

        <div class="row">
        	<div class="panel panel-default" style="margin: 20px;">
    	        <div class="panel-heading"><h4><i class="fa fa-file-text"></i> Factura</h4></div>
    	        <div class="panel-body">
    	             <?php DynamicFormWidget::begin([
    	                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    	                'widgetBody' => '.container-items', // required: css class selector
    	                'widgetItem' => '.item', // required: css class
    	                'limit' => 4, // the maximum times, an element can be cloned (default 999)
    	                'min' => 1, // 0 or 1 (default 1)
    	                'insertButton' => '.add-item', // css class
    	                'deleteButton' => '.remove-item', // css class
    	                'model' => $modelItems[0],
    	                'formId' => 'dynamic-form',
    	                'formFields' => [
    	                	'items_id_item',
                        'cantidad',
    	                ],
    	            ]); ?>

    	            <div class="container-items"><!-- widgetContainer -->
    	            <?php foreach ($modelItems as $i => $modelItem): ?>
    	                <div class="item panel panel-default"><!-- widgetBody -->
    	                    <div class="panel-heading">
    	                        <h3 class="panel-title pull-left">Items</h3>
    	                        <div class="pull-right">
    	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
    	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
    	                        </div>
    	                        <div class="clearfix"></div>
    	                    </div>
    	                    <div class="panel-body">
    	                        <?php
    	                            // necessary for update action.
    	                            if (! $modelItem->isNewRecord) {
    	                                echo Html::activeHiddenInput($modelItem, "[{$i}]factura_gastos_id_factura_gastos");
    	                            }
    	                        ?>
    	                        <div class="row">
    	                            <div class="col-sm-6">
    	                                <?= $form->field($modelItem, "[{$i}]items_id_item")->dropDownList($modelItem->listaItems, ['onchange'=>'cargarPrecioItem(this)', 'prompt' => 'Seleccione Item' ]);?>
    	                            </div>
                                  <div class="col-sm-3">
    	                                <?= $form->field($modelItem, "[{$i}]cantidad")->textInput(['class' => 'cantidad form-control', 'onblur'=>'calcularTotal()']);?>
    	                            </div>
                                  <div class="col-sm-3">
                                    <label for="">Precio Item</label>
                                      <?= Html::input('text', '', '', ['id' => "[{$i}]precio", 'class' => 'form-control', 'readonly' => true]) ?>
    	                            </div>
    	                        </div>
    	                    </div>
    	                </div>
    	            <?php endforeach; ?>
    	            </div>
    	            <?php DynamicFormWidget::end(); ?>
    	        </div>
        	</div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>
<script type="text/javascript">
  function cargarPropietario(id){
    if(id){
      $.ajax({
        url: '../usuarios/propietario',
        type: 'GET',
        data: 'id='+id,
        dataType: 'json',
        "success":function(data){
          document.getElementsByClassName('datos')[0].style.display = 'block';
          document.getElementById("nombre").value = data.nombre;
          document.getElementById("cedula").value = data.cedula;
          document.getElementById("rif").value = data.rif;
          document.getElementById("telefono").value = data.telefono;
        }
      });
    }else {
      document.getElementsByClassName('datos')[0].style.display = 'none';
    }
  }

  function cargarPrecioItem(valor){
    var id = valor.id.split("-")[1];
    console.log(id);
    $.ajax({
      url: '../items/precio',
      type: 'GET',
      data: 'id='+valor.value,
      dataType: 'json',
      "success":function(data){
        document.getElementById("[-"+id+"-]precio").value = data.precio;
      }
    });
  }

  function calcularTotal(){
    var cantidad = document.getElementsByClassName('cantidad').length;
    var total = 0, iva = 0;
    for (var i = 0; i < cantidad; i++) {
      total += document.getElementById("[-"+i+"-]precio").value * document.getElementById("facturagastositems-"+i+"-cantidad").value;
    }
    document.getElementById("facturagastos-total").value = total;
    document.getElementById("facturagastos-iva").value = document.getElementById("facturagastos-total").value * 0.12;
  }
</script>
