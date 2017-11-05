<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Poolstats */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poolstats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'block_number')->textInput() ?>

    <?= $form->field($model, 'miner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
