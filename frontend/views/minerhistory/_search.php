<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MinerhistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="minerhistory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'current_hashrate') ?>

    <?= $form->field($model, 'valid_shares') ?>

    <?= $form->field($model, 'invalid_shares') ?>

    <?php // echo $form->field($model, 'stale_shares') ?>

    <?php // echo $form->field($model, 'average_hashrate') ?>

    <?php // echo $form->field($model, 'active_workers') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
