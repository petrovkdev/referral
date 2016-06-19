<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $password;
    public $rememberMe = true;
    public $email;


    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email'      => 'Ваш e-mail',
            'password'   => 'Ваш пароль',
            'rememberMe' => 'Запомнить меня'
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
            ['password','string','min'=>3],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUsers();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Некорректный e-mail или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUsers(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUsers()
    {
        return Users::findOne(
            ['email' => $this->email]
        );
    }
}
