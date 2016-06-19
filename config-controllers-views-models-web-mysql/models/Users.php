<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property integer $referral_code
 * @property integer $bind_to_user
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  
  public function setPass($pass){
    $this->password = Yii::$app->getSecurity()->generatePasswordHash($pass);
  }
  
  public function setReferralCode($mail){
    $this->referral_code = base64_encode($mail);
  }
  
  
  /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($pass)
    {
      return Yii::$app->getSecurity()->validatePassword($pass, $this->password);
    }
    
    
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }
    
    public function getAuthKey()
    {
      
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
      
    }

}