<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absence".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property int|null $type_id
 * @property string|null $date_start
 * @property string|null $date_end
 *
 * @property Employee $employee
 */
class Absence extends \yii\db\ActiveRecord
{
    /**
     * Рабочий
    */
    const TYPE_WORK = 0;
    /**
     * Больничный
    */
    const TYPE_SICK = 1;
    /**
    * Выходной
    */
    const TYPE_WEEKEND = 2;
    /**
     * Отпуск
    */
    const TYPE_VACATION = 3;
    /**
     * Прогул
    */
    const TYPE_ABSENCE = 4;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absence';
    }

    public static function getTypes(){
        return [
                self::TYPE_WORK     => 'Рабочий',
                self::TYPE_SICK     => 'Больничный',
                self::TYPE_WEEKEND  => 'Выходной',
                self::TYPE_VACATION => 'Отпуск',
                self::TYPE_ABSENCE  => 'Прогул',
        ];
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
            'employee_id' => 'Код сотрудника',
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
}
