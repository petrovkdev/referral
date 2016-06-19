<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::$app->user->identity->email;
?>

<?if(Yii::$app->user->identity->bind_to_user):?>
  <h1>Вы пришли от <?=$from_user->email?>!</h1>
<?endif?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Зарегистрировавшихся пользователей от Вас <span class="badge pull-right"><?=count($list)?></span></h3>
  </div>
  <div class="panel-body">
    <?if(!$list):?>
      Список пуст
    <?else:?>    
      <ul class="list-group">
      <?foreach($list as $k=>$user):?>      
        <li class="list-group-item"><?=$user->email?></li>
      <?endforeach?>
      </ul>
    <?endif?>
  </div>
</div>
