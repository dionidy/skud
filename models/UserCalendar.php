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

    const TYPE_WORK = 1;
    const TYPE_VACATION = 2;
    const TYPE_WEEKEND = 3;
    const TYPE_SICK = 3;

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
            'id' => 'Код',
            'employee_id' => 'Сотрудник',
            'type_id' => 'Тип пропуска',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
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
