<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransactionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'block_number') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'current_hashrate') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'tx_hash') ?>

    <?php // echo $form->field($model, 'gpu_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
