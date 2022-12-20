<?php

use app\models\Absence;
use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AbsenceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var absenceTypes */
/** @var employeeFio */

$this->title = 'Отклонения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пропуск', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'employee_id',
                'value' => function(Absence $model){
                    return $model->employee_id ? Employee::findOne($model->employee_id)->fio : null;},
                'filter' => $employeeFio
            ],
            [
                'attribute' => 'type_id',
                'value' => function (Absence $model) use ($absenceTypes){
                    return $model->type_id ? $absenceTypes[$model->type_id] : null;},
                'filter' => $absenceTypes
            ],
//            'type_id',
            'date_start',
            'date_end',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Absence $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
