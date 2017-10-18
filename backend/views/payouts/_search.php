<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PayOutsQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-outs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'start_block') ?>

    <?= $form->field($model, 'end_block') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'tx_hash') ?>

    <?php // echo $form->field($model, 'paid_on') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
