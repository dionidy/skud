<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property string|null $date_in
 * @property string|null $date_out
 *
 * @property Employee $employee
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
}
