<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email Email
 * @property string $password_hash Хэш пароля
 * @property bool|null $is_admin Администратор
 *
 * @property UserRight[] $userRights
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_ADMIN = 1;
    const TYPE_BOSS = 2;
    const TYPE_WORKER = 3;
    
    public $password;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'is_admin'], 'required'],
            [['is_admin'], 'boolean'],
            [['email', 'password_hash', 'password'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'email' => 'Email',
            'password_hash' => 'Хэш пароля',
            'is_admin' => 'Администратор',
            'password' => 'Пароль',
        ];
    }
    
    public function beforeValidate() {
        if($this->password){
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }
        return parent::beforeValidate();
    }
    

    /**
     * Gets query for [[UserRights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRights()
    {
        return $this->hasMany(UserRight::class, ['user_id' => 'id']);
    }
}
