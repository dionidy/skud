<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "graph".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $start
 * @property string|null $end
 * @property string|null $break_start
 * @property string|null $break_end
 */
class Graph extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graph';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end', 'break_start', 'break_end'], 'safe'],
            [['name'], 'string', 'max' => 45],
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
            'start' => 'Start',
            'end' => 'End',
            'break_start' => 'Break Start',
            'break_end' => 'Break End',
        ];
    }
}