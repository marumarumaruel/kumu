<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_events".
 *
 * @property int $id
 * @property int $user_id
 * @property int $events_id
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class UserEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'events_id'], 'required'],
            [['user_id', 'events_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'events_id' => 'Events ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGuests()
    {
        return $this->hasMany(Users::classname(),['id'=>'user_id']);
    }
}
