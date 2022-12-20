<?php

use app\models\Dep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DepSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Отделы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dep-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать отдел', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'value' => function(Dep $model) {
                    return Html::a($model->name, ['employee/index', 'EmployeeSearch[dep_id]' => $model->id]);
                },
                'format' => 'raw'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Dep $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
