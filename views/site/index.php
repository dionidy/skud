<?php
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var bool $isGuest */

$this->title = 'Система';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"> Система контроля и управление доступом </h1>        

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



        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=employee/">Сотрудники</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=dep/">Отделы</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=calendar/">Произв.календарь</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=graph/">Графики работы</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=move/">Движения</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=role/">Роли</a> <br>
        <a class="btn btn-lg btn-success" href="http://localhost/yii/web/?r=user-calendar/">Отклонения</a> <br>

