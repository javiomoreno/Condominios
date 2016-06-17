<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Modificar Item #: ' . $model->id_item;
?>
<div class="items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
