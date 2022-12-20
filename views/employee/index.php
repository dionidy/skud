<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Dep;
use app\models\Graph;
/** @var yii\web\View $this */
/** @var app\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var graph_list */
/** @var dep_list */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fio',
            'num',
            [   'attribute'=>'dep_id',
                'value'=> function(Employee $model) use($dep_list) {
                    return $model->dep_id ? $dep_list[$model->dep_id] : null;},
                'filter'=>$dep_list
            ],
            [   'attribute'=>'graph_id',
                'value'=> function(Employee $model) use($graph_list) {
                    return $model->graph_id ? $graph_list[$model->graph_id] : null;},
                'filter'=>$graph_list
            ],
            'email:email',
            //'pass',
            //'salt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{update} {delete} ',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
