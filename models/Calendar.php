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
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * Рабочий день
    */
    const TYPE_WORKDAY = 1;
    
    /**
     * Выходной
    */
    const TYPE_WEEKEND = 2;
    
    /**
    * Пред праздничный день
    */
    const TYPE_PREHOLIDAY = 3;
    
    /**
     * Праздник
    */
    const TYPE_HOLIDAY = 4;
    
    /**
     * Не рабочий день
    */
    const TYPE_NOTWORK = 5;

    public static function getDayTypes():array {
        $list = [
            self::TYPE_WORKDAY      => "Рабочий",
            self::TYPE_HOLIDAY      => "Праздник",
            self::TYPE_PREHOLIDAY   => "Сокращенный",
            self::TYPE_WEEKEND      => "Выходной",
            self::TYPE_NOTWORK      => "Не рабочий"
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
            //[['type_id'], 'in', self::getDayTypes()],
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

}
