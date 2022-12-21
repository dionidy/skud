<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "total_time".
 *
 * @property int $id
 * @property int|null $employee_id Сотрудник
 * @property string|null $date Дата
 * @property int|null $work_time Отработано
 * @property int|null $absence_time Пропущено
 * @property int|null $absence_type Тип пропуска
 *
 * @property Employee $employee
 */
class TotalTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'total_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'work_time', 'absence_time', 'absence_type'], 'default', 'value' => null],
            [['employee_id', 'work_time', 'absence_time', 'absence_type'], 'integer'],
            [['date'], 'safe'],
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
            'date' => 'Дата',
            'work_time' => 'Отработано',
            'absence_time' => 'Пропущено',
            'absence_type' => 'Тип пропуска',
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
    
    public static function insertTotalTime($employee_id, $date_in, $date_out,
            $time_type = Absence::TYPE_WORK, $absence_type = Absence::TYPE_WORK){
        if (!$date_in and !$date_out) return null; 
        if ($date_in and !$date_out) return null; 
        
        if (!$date_in and $date_out) {
            //$lastMove = Move::findOne() -> where(['employee_id' => $employee_id]) -> orderby('date_in DESC');
            //как использовать date_trunc в условии ?

            $lastMove = Move::findOne()
                    ->where(['employee_id' => $employee_id])
                    ->andWhere("date_trunc('day', :date_in) = date_trunc('day', TIMESTAMP :date_out)",
                            [':date_in' => $date_in, ':date_out' => $date_out])
                    ->orderby('date_in DESC');

            if ($lastMove -> date_out) return null;
            
            $date_in = $lastMove->date_in;
        }
        
        $graph_id = Employee::findOne($employee_id)->graph_id;
        $graph = Graph::findOne($graph_id);
        if (!$graph) return null;
        
        $date_out = strtotime($date_out);
        $date_in  = strtotime($date_in);
        
        if ($date_out <= $graph->start) return null;
        
        if ($date_in >= $graph->break_start 
                and $date_out <= $graph->break_end) return null;
        
        if ($date_in <= $graph->break_start)
            $date_in = max($date_in, $graph->start);
        else
            $date_in = $graph->break_end; 
                
        $model = new self;
        $model -> employee_id = $employee_id;
        $date = date('Y-m-d', strtotime($date_out)); 
        $model -> date =  $date;
        $model -> absence_type = $absence_type;
        $totalMinutes = ceil((strtotime($date_out) - strtotime($date_in))/60);
        if($time_type==Absence::TYPE_WORK){
            $model -> work_time = $totalMinutes;
            $model -> absence_time = 0;
        }else{
            $model -> work_time = 0;
            $model -> absence_time = $totalMinutes;
        }
        $model->save();
    }
    
//    public static function getTotalMinutes(Interval $int){
//        return ($int->d * 24 * 60) + ($int->h * 60) + $int->i;
//    }
    
}
