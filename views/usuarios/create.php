<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Nuevo Usuario';
?>
<div class="usuarios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
