<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegistrationForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegForm extends Model
{
    
    public $password;
    public $email;
    public $referral;


    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email'    => 'Ваш e-mail',
            'password' => 'Ваш пароль'
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email','email'],
            ['email','unique','targetClass'=>'app\models\Users'],
            ['password','string','min'=>3],
            ['referral','string'],
        ];
    }

    /**
     * @return bool
     */
    public function reg()
    {
        if ($this->validate()){            
            $user        = new Users();
            $user->email = $this->email;
            
            $user->setPass($this->password);
            
            if($this->referral){
                $bind_to_user = $user->findOne(['referral_code' => $this->referral]);
                $user->bind_to_user = $bind_to_user->id;
            }
            
            $user->save();            
        }
        
        return false;
    }

}

?>