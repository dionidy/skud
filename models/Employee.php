<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string|null $fio
 * @property int|null $num
 * @property int|null $dep_id
 * @property int|null $graph_id
 * @property string|null $email
 * @property string|null $pass
 * @property string|null $salt
 *
 * @property Dep $dep
 * @property Move[] $moves
 * @property UserCalendar[] $userCalendars
 * @property User[] $users
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num', 'dep_id', 'graph_id'], 'default', 'value' => null],
            [['num', 'dep_id', 'graph_id'], 'integer'],
            [['fio', 'email'], 'string', 'max' => 45],
            [['pass'], 'string', 'max' => 50],
            [['salt'], 'string', 'max' => 9],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dep::class, 'targetAttribute' => ['dep_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'num' => 'Табельный номер',
            'dep_id' => 'Отдел',
            'graph_id' => 'График работы',
            'email' => 'Email',
            'pass' => 'Pass',
            'salt' => 'Salt',
        ];
    }

    /**
     * Gets query for [[Dep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Dep::class, ['id' => 'dep_id']);
    }

    /**
     * Gets query for [[Moves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoves()
    {
        return $this->hasMany(Move::class, ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[UserCalendars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCalendars()
    {
        return $this->hasMany(UserCalendar::class, ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['employee_id' => 'id']);
    }
    

    
    
}
