<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PayOuts */

$this->title = 'Create Pay Outs';
$this->params['breadcrumbs'][] = ['label' => 'Pay Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-outs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
