<?php

use app\models\Move;
use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MoveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var employeeList */

$this->title = 'Движения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="move-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать движение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [   'attribute'=>'employee_id',
                'value'=> function(Move $model) {
                    return $model->employee_id ? Employee::findOne($model->employee_id)->fio : null;},
                'filter'=>$employeeList
            ],
            'date_in',
            'date_out',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Move $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
               'template' => '{update} {delete} ',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
