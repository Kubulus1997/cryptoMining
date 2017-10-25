<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\workerhistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workerhistory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_seen')->textInput() ?>

    <?= $form->field($model, 'reported_hashrate')->textInput() ?>

    <?= $form->field($model, 'average_hashrate')->textInput() ?>

    <?= $form->field($model, 'current_hashrate')->textInput() ?>

    <?= $form->field($model, 'valid_shares')->textInput() ?>

    <?= $form->field($model, 'invalid_shares')->textInput() ?>

    <?= $form->field($model, 'stale_shares')->textInput() ?>

    <?= $form->field($model, 'gpu_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
