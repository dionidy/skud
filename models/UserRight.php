<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_right".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $type Тип
 * @property int $dep_id Отдел
 *
 * @property Dep $dep
 * @property User $user
 */
class UserRight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_right';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'dep_id'], 'required'],
            [['user_id', 'type', 'dep_id'], 'default', 'value' => null],
            [['user_id', 'type', 'dep_id'], 'integer'],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dep::class, 'targetAttribute' => ['dep_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'type' => 'Тип',
            'dep_id' => 'Отдел',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
