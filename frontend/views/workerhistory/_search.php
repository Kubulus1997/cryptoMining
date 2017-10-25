<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\workerhistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workerhistory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'last_seen') ?>

    <?= $form->field($model, 'reported_hashrate') ?>

    <?= $form->field($model, 'average_hashrate') ?>

    <?= $form->field($model, 'current_hashrate') ?>

    <?= $form->field($model, 'valid_shares') ?>

    <?php // echo $form->field($model, 'invalid_shares') ?>

    <?php // echo $form->field($model, 'stale_shares') ?>

    <?php // echo $form->field($model, 'gpu_id') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
