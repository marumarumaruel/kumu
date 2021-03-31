<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\Events;
use app\models\UserEvents;

class ReportsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = [];

        $users = Users::find()->all();
        $data['users'] = $users;

        $events = Events::find()->all();
        $data['events'] = $events;

        $userEvents = UserEvents::find()->all();
        $data['user_events'] = $userEvents;

        $eventData = [];
        foreach($events as $key => $event)
        {
            $eventData[$key]['event'] = $event;
            $userEvents = $event->getUserEvents()->all();
            if(!empty($userEvents)) {
              foreach($userEvents as $userEvent)
              {
                  $eventData[$key]['guests'][] = $userEvent->getGuests()->all()[0];
              }
            } else {
              $eventData[$key]['guests'] = [];
            }

        }
        $data['events'] = $eventData;

        return $this->render('index',$data);
    }

    public function actionDownloadGuests($eventID)
    {
        $event = Events::findOne($eventID);

        $eventData = [];
        $eventData['event'] = $event;
        $userEvents = $event->getUserEvents()->all();
        foreach($userEvents as $userEvent)
        {
            $eventData['guests'][] = $userEvent->getGuests()->all()[0];
        }

        $eventCSV = [
            ['Event Name:',$eventData['event']->name],
            ['ID','First Name','Last Name','Email','Phone Number','Gender']
        ];
        foreach($eventData['guests'] as $guest)
        {
            $eventCSV[] = [
              $guest->id,
              $guest->first_name,
              $guest->last_name,
              $guest->email,
              $guest->phone_number,
              $guest->gender,
            ];
        }

        $fileName = preg_replace('/\s+/', '', $eventData['event']->name).'.csv';
        $fp = fopen('downloads/'.$fileName, 'w');
        foreach ($eventCSV as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        header('HTTP/1.1 200 OK');
        header('Cache-Control: no-cache, must-revalidate');
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");
        readfile('downloads/'.$fileName);
        exit;
    }

}
