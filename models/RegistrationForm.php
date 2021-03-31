<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Users;
use app\models\Events;
use app\models\UserEvents;

/**
 * RegistrationForm is the model behind the Registration form.
 *
 */
class RegistrationForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $gender;
    public $street;
    public $city;
    public $country;
    public $zip;
    public $events = [];

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone_number', 'gender', 'street', 'city', 'country', 'zip'], 'required'],
            [['email'], 'string'],
            [['first_name', 'last_name', 'street', 'city', 'country', 'zip'], 'string', 'max' => 120],
            [['phone_number'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 25],
            ['events', 'each', 'rule' => ['integer']]
        ];
    }

    public function register()
    {
        $users = new Users();
        $users->first_name = $this->first_name;
        $users->last_name = $this->last_name;
        $users->email = $this->email;
        $users->phone_number = $this->phone_number;
        $users->gender = $this->gender;
        $users->street = $this->street;
        $users->city = $this->city;
        $users->country = $this->country;
        $users->zip = $this->zip;

        if($users->save()) {
          $events = $this->events;
          foreach($events as $event)
          {
            $userEvents = new UserEvents();
            $userEvents->user_id = $users->id;
            $userEvents->events_id = $event;
            $userEvents->save();
          }
          return true;
        }

        Yii::error("Registration unsuccessful.");
        return false;
    }

}
