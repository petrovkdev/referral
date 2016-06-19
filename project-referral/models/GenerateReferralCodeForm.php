<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * GenerateReferralCodeForm is the model behind the login form.
 *
 */

class GenerateReferralCodeForm extends Model
{
    public $referral_code;
    
    /**
     * @return bool 
     */
    public function generateReferralCode()
    {
        $user = Users::findOne(['id' => Yii::$app->user->identity->id]);
        $user->setReferralCode(Yii::$app->user->identity->email);
        return $user->save();
    }
}