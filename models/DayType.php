<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day_type".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Calendar[] $calendars
 * @property UserCalendar[] $userCalendars
 */
class DayType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Calendars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalendars()
    {
        return $this->hasMany(Calendar::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[UserCalendars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCalendars()
    {
        return $this->hasMany(UserCalendar::class, ['type_id' => 'id']);
    }
}
