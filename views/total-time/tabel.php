<?php

use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\Html;
/**
 * @var dayTypes
 */


$this->title = 'Учет тработанного времени';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['method' => 'get']);

echo $form->field($searchModel, 'dateBegin')->widget(DatePicker::class,[
    'value'     => date('d-M-Y'),
    'options'   => ['placeholder' => 'Выберите дату начала'],
]);

echo $form->field($searchModel, 'dateEnd')->widget(DatePicker::class,[
    'value'     => date('d-M-Y'),
    'options'   => ['placeholder' => 'Выберите дату окончания']
]);

echo Html::submitButton('Сформировать', ['class' => 'btn btn-success']);

ActiveForm::end();

Pjax::begin();
echo GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => ['dep', 'fio', 'date', 'norm',
        [
            'attribute' => 'dt',
            'value' => function(array $model) use ($dayTypes){
                return $model['dt'] ? $dayTypes[$model['dt']] : null;},
            'filter' => $dayTypes,
        ],
        'work', 'over', 'absence' ],
]);
