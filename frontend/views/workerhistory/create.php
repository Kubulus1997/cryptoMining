<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\workerhistory */

$this->title = 'Create Workerhistory';
$this->params['breadcrumbs'][] = ['label' => 'Workerhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workerhistory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
