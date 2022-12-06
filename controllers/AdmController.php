<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * здесь будут жить админские разделы 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class AdmController extends Controller{


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => [],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            //'matchCallback' => function(app\models\User)
                        ],
                    ],
            ],
                
            ]
        );
    }

    /**
     * Lists all UserRight models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }
    
}