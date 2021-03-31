<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<h3>Search Results</h3>
<ol class="list-group">
<?php foreach($users as $user): ?>
<li class="list-group-item"><?= Html::a($user->first_name.' '.$user->last_name, [Url::to(['/users/view','id'=>$user->id])]) ?></li>
<?php endforeach ?>
</ol>
