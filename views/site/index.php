<?php
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var bool $isGuest */

$this->title = 'Система контроля и управления доступом';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"> Система контроля и управления доступом </h1>        

        <?php
        if($isGuest) {
            echo Html::a('Вход', ['site/login'], ['class' => 'btn btn-success']);
        } else { ?>
        <p>
            <?= Html::a('Сотрудники', ['employee/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Подразделения', ['dep/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Графики работы', ['graph/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Произв. календарь', ['calendar/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Отклонения', ['user-calendar/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Пользователи', ['user/index'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php } ?>
    </div>    
</div>

