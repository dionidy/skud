<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day_type".
 *
 * @property int $id
 * @property string|null $type Тип
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
            [['type'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
        ];
    }
    
    public static function getDayTypes():array {
        $models = self::find()->where(['type'=>['Выходной','Праздник']])->orderBy('id')->all();
        $list = [];
        foreach ($models as $model) {
            $list[$model->id] = $model->type;
        }
        return $list;
    }
    
}
