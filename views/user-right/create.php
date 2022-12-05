<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserRight $model */

$this->title = 'Create User Right';
$this->params['breadcrumbs'][] = ['label' => 'User Rights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-right-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
