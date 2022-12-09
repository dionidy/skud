<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property int $id
 * @property string|null $date Дата
 * @property int|null $type_id Тип
 *
 * @property DayType $type
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * Праздник
    */
    const TYPE_HOLIDAY = 1;
    /**
     * Пред праздничный день
    */
    const TYPE_PREHOLIDAY = 2;
    /**
     * Выходной
    */
    const TYPE_WEEKEND = 3;
    /**
     * Не рабочий день
    */
    const TYPE_NOTWORK = 4;

    public static function getDayTypes():array {
        $list = [
                self::TYPE_HOLIDAY,
                self::TYPE_PREHOLIDAY,
                self::TYPE_WEEKEND,
                self::TYPE_NOTWORK 
        ];

        return $list;
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['type_id'], 'default', 'value' => null],
            [['type_id'], 'integer'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DayType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'type_id' => 'Вид дня',
        ];
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
