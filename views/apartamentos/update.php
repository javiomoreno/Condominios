<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Apartamentos */

$this->title = 'Update Apartamentos: ' . $model->id_apartamento;
$this->params['breadcrumbs'][] = ['label' => 'Apartamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_apartamento, 'url' => ['view', 'id' => $model->id_apartamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apartamentos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
