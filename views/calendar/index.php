<?php

use app\models\Calendar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CalendarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var dayTypes */


$this->title = 'Производственный календарь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date:date',
            [
                'attribute' => 'type_id',
                'value' => function(Calendar $model) use($dayTypes){
                    return $model->type_id ? $dayTypes[$model->type_id] : null; 
                },
                'filter' => $dayTypes,
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Calendar $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
