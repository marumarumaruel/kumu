<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Reports';
?>
<h1>Reports</h1>

<!-- <pre>
<?php //print_r($users); ?>
<?php //print_r($events); ?>
<?php //print_r($user_events); ?>
</pre> -->

<?php foreach($events as $event): ?>
<hr/>
<h4>Event Name: <?= $event['event']->name ?></h4>
<h5>Location: <?= $event['event']->location ?></h5>
<?php $dateTime = new DateTime($event['event']->date_time); ?>
<h5>Date: <?= $dateTime->format('Y-m-d') ?></h5>
<h5>Time: <?= $dateTime->format('h:iA') ?></h5>
<h4>Attendees:</h4>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Gender</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($event['guests'] as $key => $guest): ?>
    <tr>
      <th scope="row"><?= $key+1 ?></th>
      <td><?= $guest->first_name ?></td>
      <td><?= $guest->last_name ?></td>
      <td><?= $guest->email ?></td>
      <td><?= $guest->phone_number ?></td>
      <td><?= $guest->gender ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div><?= Html::a('Download Report', [Url::to(['/admin/reports/download-guests','eventID'=>$event['event']->id])]) ?></div>
<hr/>
<br/>
<?php endforeach ?>
