<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_calendar".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property int|null $type_id
 * @property string|null $date_start
 * @property string|null $date_end
 *
 * @property Employee $employee
 * @property DayType $type
 */
class UserCalendar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_calendar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'type_id'], 'default', 'value' => null],
            [['employee_id', 'type_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DayType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'employee_id' => 'Employee ID',
            'type_id' => 'Type ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DayType::class, ['id' => 'type_id']);
    }
}
