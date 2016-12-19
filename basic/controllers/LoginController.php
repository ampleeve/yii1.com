<?php
/**
 * Created by PhpStorm.
 * User: evgenijampleev
 * Date: 16.12.16
 * Time: 16:17
 */

namespace app\controllers;


use app\models\LoginForm;
use yii\base\Controller;
class LoginController extends Controller
{
    public function actionLogin(){

        if(!\Yii::$app->user->isGuest){

            return $this->goHome();

        }

        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN]);

        if($model->load(\Yii::$app->request->post()) && $model->login()){

            return $this->goBack();

        }

        return $this->render('MyLogin',['model'=>$model]);



    }

    public function actionRegister(){


        if(!\Yii::$app->user->isGuest){

            return $this->goHome();

        }

        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_REGISTER]);

        if($model->load(\Yii::$app->request->post()) && $model->login()){

            return $this->goBack();

        }

        return $this->render('MyRegister',['model'=>$model]);

    }

}