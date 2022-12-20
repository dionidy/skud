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
}
