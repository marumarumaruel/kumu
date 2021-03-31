<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $date_time
 * @property int $is_active
 * @property int|null $created_at
 * @property int|null $updated_at
 */

 use yii\behaviors\TimestampBehavior;

class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location', 'date_time', 'is_active'], 'required'],
            [['location'], 'string'],
            [['date_time'], 'safe'],
            [['is_active', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 120],
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
            'location' => 'Location',
            'date_time' => 'Date Time',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUserEvents()
    {
        return $this->hasMany(UserEvents::classname(),['events_id'=>'id']);
    }
}
