<?php

namespace app\controllers;

use app\models\TotalTime;
use app\models\TotalTimeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\base\Model;
use yii\data\Sort;
use yii;

/**
 * TotalTimeController implements the CRUD actions for TotalTime model.
 */
class TotalTimeController extends Controller
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
     * Lists all TotalTime models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TotalTimeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TotalTime model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TotalTime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TotalTime();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                calcTotalTime();
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TotalTime model.
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
     * Deletes an existing TotalTime model.
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
     * Finds the TotalTime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TotalTime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TotalTime::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionTabel(){
        $searchModel = new TabelForm;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('tabel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dayTypes' => \app\models\Calendar::getDayTypes(),
        ]);
    }

}

class TabelForm extends Model{
    public $dateBegin;
    public $dateEnd;
    public $dep;
    public $fio;
    public $date;
    public $norm;
    public $dt;
    public $work;
    public $over;
    public $absence;

    public function attributeLabels(){
        return[
            'dep'    => 'Отдел',
            'fio'    => 'ФИО',
            'date'   => 'Дата',
            'norm'   => 'Дн.норма',
            'dt'     => 'Тип дня',
            'work'   => 'Отработано',
            'over'   => 'Сверхурочно',
            'absence'=> 'Пропуск',
            'dateBegin'=> 'Начало периода',
            'dateEnd'=> 'Конец периода',
        ];
    }
    
    public function rules() {
        return [
            [['dep', 'fio',], 'string'],
            [['norm', 'dt', 'work', 'over', 'absence'],'integer'],
            [['date','dateBegin', 'dateEnd'], 'date', 'format'=>'php:d.m.Y'],
        ];
    }
    
    public function search(array $params): ActiveDataProvider {
        $query = (new Query())->select('d.name as dep, e.fio, c.date, g.norm, c.type_id as dt,
                        sum(work_time) as work,
                        sum(over_time) as over,
                        g.norm-sum(work_time) as absence')
                ->from('total_time t')
                ->innerJoin(['e' => 'employee'], 't.employee_id=e.id')
                ->innerJoin(['g' => 'graph'], 'e.graph_id=g.id')
                ->innerJoin(['d' => 'dep'], 'e.dep_id=d.id')
                ->rightJoin(['c' => 'calendar'], 't.date = c.date')
                ->groupBy('d.name, e.fio, c.date, g.norm, c.type_id');
        
        $sort = new Sort([
                'attributes' => [
                    'dep',
                    'fio',
                    'dt',
                    'date'=>[
                        'asc' => ['date' => SORT_ASC, 'fio' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC, 'fio' => SORT_ASC],
                    ],
                ],
        ]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'dep' => $this->dep,
            'fio' => $this->fio,
            'norm'=> $this->norm,
            'c.type_id'  => $this->dt,
        ]);
        
        $this->dt = $this->dt ? $this->dt : 1;
        $query->andFilterWhere(['c.type_id' => $this->dt]);
                
        $query->andWhere(['>=', 'c.date', $this->dateBegin])
              ->andWhere(['<=', 'c.date', $this->dateEnd]);

        return $dataProvider;
    }
    
}

