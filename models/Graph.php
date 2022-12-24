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
    public $canOverTime = false;
    
    
    /**
     * минимальное время для учета сверхурочной работы
    */
    const MIN_OVERTIME = 30;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end', 'break_start', 'break_end'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['norm'], 'integer'],
            [['start', 'end', 'norm'], 'required'],
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
            'norm' => 'Дневная норма',
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
     * Подсчет минут периода timeIn - timeOut, 
     * входящих в интервал IintStart - intEnd
     */
    public function calcTimeInInterval(string $intStart, string $intEnd, string $timeIn, string $timeOut){
        if ($timeIn > $intEnd or $timeOut < $intStart)
            return 0;
        if ($timeIn <= $intStart and $timeOut >= $intEnd)
            return ($intEnd - $intStart)/60;
        if ($timeIn <= $intStart and $timeOut <= $intEnd)
            return ($timeOut - $intStart)/60;
        if ($timeIn >= $intStart and $timeOut <= $intEnd)
            return ($timeOut - $timeIn)/60;
        if ($timeIn >= $intStart and $timeOut >= $intEnd)
            return ($intEnd - $timeIn)/60;
    }
     
    public function getTotalWorkMin(string $date_in, string $date_out){
        $timeIn  = strtotime(explode(" ", $date_in)[1]);
        $timeOut = strtotime(explode(" ", $date_out)[1]);
        
        if ($timeIn>=$timeOut) return 0;
        
        $totalTime = 0;
        $totalTime += $this->calcTimeInInterval(strtotime($this->start),
                                strtotime($this->break_start),
                                $timeIn,
                                $timeOut
                                );
        
        $totalTime += $this->calcTimeInInterval(
                                strtotime($this->break_end),
                                strtotime($this->end),
                                $timeIn,
                                $timeOut
                                );
 
        return ceil($totalTime);
    }
    
    public function getOverTimeMin(string $date_in, string $date_out){
        $timeIn  = strtotime(explode(" ", $date_in)[1]);
        $timeOut = strtotime(explode(" ", $date_out)[1]);
        
        if ($timeIn>=$timeOut) return 0;
        
        $totalTime = 0;
        $time = $this->calcTimeInInterval(strtotime('00:00:00'),
                                $this->start,
                                $timeIn,
                                $timeOut);
        $totalTime += $time>self::MIN_OVERTIME ? time : 0;
        
        $totalTime += $this->calcTimeInInterval(strtotime($this->end),
                                strtotime('23:59:59'),
                                $timeIn,
                                $timeOut);
        $totalTime += $time>self::MIN_OVERTIME ? time : 0;
        
        return ceil($totalTime);
    }

}
