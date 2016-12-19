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
    public $email;
    public $password;
    public $passwordRepeat;
    public $rememberMe = true;

    private $_user = false;

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    public function scenarios(){

        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['email', 'password'];
        $scenarios[self::SCENARIO_REGISTER] = ['email', 'password', 'passwordRepeat'];
        return $scenarios;

    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['rememberMe'], 'boolean', 'on' => self::SCENARIO_LOGIN],
            [['password','passwordRepeat'], 'validatePassword', 'on' => self::SCENARIO_LOGIN],
            [['email', 'password', 'passwordRepeat'], 'required', 'on' => self::SCENARIO_REGISTER],
        ];
    }

    public function attributeLabels()
    {
        return [

            'email' => 'Электронный адрес:',
            'password' => 'Пароль:',
            'passwordRepeat' => 'Повторите пароль:',
            'rememberMe' => 'Запомнить меня на этом устройстве'

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
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные email или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
