<?php

namespace app\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "move".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property string|null $date_in
 * @property string|null $date_out
 *
 * @property Employee $employee
 * @property Move $lastMove
 */
class Move extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'move';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id'], 'default', 'value' => null],
            [['employee_id'], 'integer'],
            [['date_in', 'date_out'], 'safe'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Сотрудник',
            'date_in' => 'Вход',
            'date_out' => 'Выход',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }
    
    /**
     * Возвращает последнее движение по сотруднику за день где выход не заполнен
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLastEntry() {
        $dayBegin = $this->date_out ? explode(" ", $this->date_out)[0] : null;
        if (!$dayBegin) return null;
        $dayEnd = new DateTime($dayBegin);
        $dayEnd = $dayEnd->modify('+1 day')->format("Y-m-d");
        
        return $this->hasOne(Move::class, ['employee_id' => 'employee_id'])
                ->andWhere(['>=', 'date_in', $dayBegin])
                ->andWhere(['<', 'date_in', $dayEnd])
                ->andWhere(['date_out'=>null])
                ->orderBy(['date_in'=>SORT_DESC]);
    }
    
    
    /** 
     * проверка на заполненные поля date_in, graph,
     * @return boolean 
     */
    public function canCalcTime(){
        if (!$this->date_out) return false; 
        
        $lastEntry = $this->lastEntry;
        if (!$lastEntry) return false;
        
        $graph = $this->employee->graph;
        if (!$graph) return false;

        return true;        
    }
            
    
}
