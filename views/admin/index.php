<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Admin';
?>
<h1>Admin</h1>

<h3><?= Html::a('Manage Guests', [Url::to(['/users'])]) ?></h3>
<h3><?= Html::a('Manage Events', [Url::to(['/events'])]) ?></h3>
<h3><?= Html::a('Reports', [Url::to(['/reports'])]) ?></h3>

<hr />

<input type="text" id="search_guest" placeholder="Search Guests"></input>

<div id=search_results></div>
