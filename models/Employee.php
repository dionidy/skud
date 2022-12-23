<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string|null $fio   ФИО
 * @property int|null $num      Таб. номер
 * @property int|null $dep_id   ид подразделения
 * @property int|null $graph_id ид графика работы
 * @property string|null $email
  *
 * @property Dep $dep
 * @property Move[] $moves
 * @property UserCalendar[] $userCalendars
 * @property User[] $users
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num', 'dep_id', 'graph_id'], 'default', 'value' => null],
            [['num', 'dep_id', 'graph_id'], 'integer'],
            [['fio', 'email'], 'string', 'max' => 45],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dep::class, 'targetAttribute' => ['dep_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'num' => 'Табельный номер',
            'dep_id' => 'Отдел',
            'graph_id' => 'График работы',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Dep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Dep::class, ['id' => 'dep_id']);
    }

    /**
     * Gets query for [[Moves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoves()
    {
        return $this->hasMany(Move::class, ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Absence]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbsences()
    {
        return $this->hasMany(Absence::class, ['employee_id' => 'id']);
    }
    
    /**
     * Gets query for [[Graph]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGraph()
    {
        return $this->hasOne(Graph::class, ['id' => 'graph_id']);
    }
    

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['employee_id' => 'id']);
    }
    
    public static function getEmployeeFio(){
        $models = Employee::find()->orderBy('id')->all();
        $list = [];
        foreach($models as $model){
            $list[$model->id] = $model->fio;
        }
        return $list;
    }
  

    
    
}
