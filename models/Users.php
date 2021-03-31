<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $gender
 * @property string $street
 * @property string $city
 * @property string $country
 * @property string $zip
 * @property string|null $created_at
 * @property string|null $updated_at
 */

use yii\behaviors\TimestampBehavior;

class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
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
            [['first_name', 'last_name', 'email', 'phone_number', 'gender', 'street', 'city', 'country', 'zip'], 'required'],
            [['email'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'street', 'city', 'country', 'zip'], 'string', 'max' => 120],
            [['phone_number'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'gender' => 'Gender',
            'street' => 'Street',
            'city' => 'City',
            'country' => 'Country',
            'zip' => 'Zip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
