<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property string|null $in
 * @property string|null $out
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
            [['in', 'out'], 'safe'],
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
            'in' => 'In',
            'out' => 'Out',
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
