<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Реферальная ссылка';
$this->params['breadcrumbs'][] = $this->title;

?>
<?if(Yii::$app->user->identity->referral_code):?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
  </div>
  <div class="panel-body">
    <?=Yii::$app->request->serverName.'/?referral='.Yii::$app->user->identity->referral_code;?>
  </div>
</div>
<?else:?>

<?php 
  $form = ActiveForm::begin([
    'id' => 'referral-form',
    'options' => ['class' => 'form-horizontal'],
  ]); 
?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton('Сгенерировать реферальную ссылку', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?endif?>