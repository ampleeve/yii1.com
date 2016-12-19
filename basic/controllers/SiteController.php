<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\TestModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionTest(){

        //Пример 1
        //Получение доступа к атрибуту как к обычному свойству объекта
        //$model = new \app\models\ContactForm;
        //$model->name = 'example';
        //echo $model->name;

        //Пример 2
        //Также возможно получить доступ к атрибутам как к элементам массива,
        //спасибо поддержке ArrayAccess и ArrayIterator в y ii\base\Model:
        //$model = new \app\models\ContactForm;
        //$model['name'] = 'example';
        //$model['body'] = 'текст в боди';

        //foreach ($model as $name => $value){

          //  echo "$name: $value<br>";

        //Пример 3
        $model = new \app\models\ContactForm();
        echo $model->getAttributeLabel('email');


    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){

       // echo '<pre>';
        //var_dump(\Yii::$app->test->sum());

        return $this->render('index');
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
