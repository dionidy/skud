<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "graph".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $start
 * @property string|null $end
 * @property string|null $break_start
 * @property string|null $break_end
 */
class Graph extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graph';
    }

    
    /**
     * возможность сверхурочной работы
     * @var type = boolean
    */
    //public $canOverTime = false;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end', 'break_start', 'break_end'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'start' => 'Время начала',
            'end' => 'Время окончания',
            'break_start' => 'Начало перерыва',
            'break_end' => 'Окончание перерыва',
        ];
    }
    
    public static function getList():array {
        $models = self::find()->orderBy("id")->all();
        $list = [];
        foreach ($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    
    /**
     * 
     */
    public function calcTimeInInterval($intStart, $intEnd, $timeIn, $timeOut){
        if ($timeIn > $intEnd or $timeOut < $intStart)
            return 0;
        if ($timeIn <= $intStart and $timeOut >= $intEnd)
            return $intEnd - $intStart;
        if ($timeIn <= $intStart and $timeOut <= $intEnd)
            return $timeOut - $intStart;
        if ($timeIn >= $intStart and $timeOut <= $intEnd)
            return $timeOut - $timeIn;
        if ($timeIn >= $intStart and $timeOut >= $intEnd)
            return $intEnd - $timeIn;
    }
     
    public function getTotalWorkMin($date_in, $date_out){
        $timeIn  = strtotime(explode(" ", $date_in)[1]);
        $timeOut = strtotime(explode(" ", $date_out)[1]);
        
        if ($timeIn>=$timeOut) return 0;
        
        $totalTime = 0;
        $intStart= strtotime($this->start);
        $intEnd  = strtotime($this->break_start);
        $totalTime += $this->calcTimeInInterval($intStart, $intEnd, $timeIn, $timeOut);
        
        $intStart= strtotime($this->break_end);
        $intEnd  = strtotime($this->end);
        $totalTime += $this->calcTimeInInterval($intStart, $intEnd, $timeIn, $timeOut);
 
        return $totalTime/60;
    }
  
    
}
