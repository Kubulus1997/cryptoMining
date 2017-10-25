<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Minerhistory */

$this->title = 'Create Minerhistory';
$this->params['breadcrumbs'][] = ['label' => 'Minerhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minerhistory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
