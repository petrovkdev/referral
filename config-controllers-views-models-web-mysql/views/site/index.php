<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';


?>
<div class="site-index">

    <div class="body-content">

        <h1><?= Html::encode($this->title) ?></h1>
        
        <p>Пожалуйста, заполните следующие поля для регистрации:</p>
        <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    
    
    
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        
        <?
          if(Yii::$app->request->get('referral')){
            
            echo $form->field($model, 'referral')
                      ->hiddenInput(['value' => Yii::$app->request->get('referral')])
                      ->label(false);
          }         
          
        ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    
    
    

    </div>
</div>
