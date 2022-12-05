<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dep".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Employee[] $employees
 */
class Dep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Название',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['dep_id' => 'id']);
    }
    
    public static function getList():array {
        $models = self::find()->orderBy('id')->all();
        $list = [];
        foreach ($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    
}
