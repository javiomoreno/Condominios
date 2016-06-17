<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Modificar Usuario #: ' . $model->id_usuario;
?>
<div class="usuarios-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
