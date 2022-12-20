<?php

namespace app\controllers;

use app\models\Absence;
use app\models\AbsenceSearch;
use app\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AbsenceController implements the CRUD actions for Absence model.
 */
class AbsenceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Absence models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel    = new AbsenceSearch();
        $dataProvider   = $searchModel->search($this->request->queryParams);
        $absenceTypes   = Absence::getTypes();
        $employeeFio    = Employee::getEmployeeFio();
        
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'absenceTypes'  => $absenceTypes,
            'employeeFio'   => $employeeFio,
        ]);
    }

    /**
     * Displays a single Absence model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new Absence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Absence();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $absenceTypes   = Absence::getTypes();
        $employeeFio    = Employee::getEmployeeFio();
        
        return $this->render('form', [
            'model' => $model,
            'absenceTypes' => $absenceTypes,
            'employeeFio' => $employeeFio
        ]);
    }

    /**
     * Updates an existing Absence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Absence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Absence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Absence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Absence::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
