<?php

namespace app\controllers;

use app\models\Description;
use app\models\OrderForm;
use app\models\ZakazForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use \app\models\Regions;
use \app\models\Technics;
use \app\models\ListInDB;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    /*
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
    */

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

    public function actionOrders($region = 'none', $tech = 'none') //vivod spiska zayavok na remont
    {
        if (!Yii::$app->user->isGuest) {
            $reg = new Regions();
            $tec = new Technics();

            $reg_items = $reg->getRegions();
            $tec_items = $tec->getTechnics();

            $query = ListInDB::getListOfOrders($region, $tech);
            $pages = new Pagination(['totalCount' => ListInDB::$count]);
            $pages->pageSizeLimit = [1, 10];
            $orders = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $model = compact('reg_items', 'tec_items', 'orders', 'pages');
            if (\Yii::$app->user->identity->type == 1) //user is master
                return $this->render('orders', ['model' => $model]);
            else
                $this->redirect(array('user/login'));
        } else {
            $this->redirect(array('user/login'));
        }
    }

    public function actionOrder() { //oformlenie zakazov na remont
        if (!Yii::$app->user->isGuest) {
            $success = false;
            $model = new OrderForm;
            if (Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->upload()) {
                    $success = true;
                }

                if ($model->saveRecord(\Yii::$app->request->post('OrderForm')))
                    $success = true;
            }

            $tech = Technics::find()->where(['active' => '1', 'deleted' => '0'])->all();
            $tech = ArrayHelper::map($tech, 'id', 'name');

            $reg = new Regions();
            $reg_items = $reg->getRegions();

            if (\Yii::$app->user->identity->type == 0) //user is client
                return $this->render('order', ['model' => $model, 'tech' => $tech, 'success' => $success, 'reg_items' => $reg_items]);
            else //user is master
                $this->redirect(array('user/login'));
        } else
            $this->redirect(array('user/login'));
    }

    public function actionMasters($region = 'none', $tech = 'none') {
        $reg = new Regions();
        $tec = new Technics();
        
        $reg_items = $reg->getRegions();
        $tec_items = $tec->getTechnics();
        
        $query = ListInDB::getListOfMasters($region, $tech);
        $pages = new Pagination(['totalCount' => ListInDB::$count]);
        $pages->pageSizeLimit = [1, 10];
        $masters = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        $model = compact('reg_items', 'tec_items', 'masters', 'pages');

        if (!Yii::$app->user->isGuest) {
            if (\Yii::$app->user->identity->type == 1) { //user is master
                $this->redirect(array('user/login'));
            }
        }

        return $this->render('masters', ['model' => $model]);
    }

    public function actionZakaz() { //oformlenie zakaza na zapchast
        if (!Yii::$app->user->isGuest) {
            $success = false;
            $model = new ZakazForm();
            if (Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->upload()) {
                    $success = true;
                }

                if ($model->saveRecord(\Yii::$app->request->post('ZakazForm')))
                    $success = true;
            }
            if (\Yii::$app->user->identity->type == 0) { //user is client
                $reg = new Regions();
                $reg_items = $reg->getRegions();

                $tech = Technics::find()->where(['active' => '1', 'deleted' => '0'])->all();
                $tech = ArrayHelper::map($tech, 'id', 'name');
                return $this->render('zakaz', ['model' => $model, 'success' => $success, 'reg_items' => $reg_items , 'tech' => $tech]);
            } else //user is master
                $this->redirect(array('user/login'));
        } else
            $this->redirect(array('user/login'));
    }

    public function actionZakazi($region = 'none', $tech = 'none') { //vivod spiska zayavok na zapchasti
        if (!Yii::$app->user->isGuest) {
            $reg = new Regions();
            $tec = new Technics();

            $reg_items = $reg->getRegions();
            $tec_items = $tec->getTechnics();

            $query = ListInDB::getListOfZakazi($region, $tech);

            $pages = new Pagination(['totalCount' => ListInDB::$count]);
            $pages->pageSizeLimit = [1, 10];
            $zakazi = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $model = compact('reg_items', 'zakazi', 'pages', 'tec_items');
            if (\Yii::$app->user->identity->type == 1) //user is master
                return $this->render('zakazi', ['model' => $model]);
            else //user is client
                $this->redirect(array('user/login'));
        } else
            $this->redirect(array('user/login'));
    }

    public function actionFaq() {
        return $this->render('faq');
    }

    public function actionSupport() {
        return $this->render('support');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDescription($id) {
        $result = Description::getPost($id);
        return $this->render('description' , ['model' => $result]);
    }

//    /**
//     * Login action.
//     *
//     * @return string
//     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        }
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }
//
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
    
    public function actionSuccess() {
        return $this->render('success');
    }
//
//    /**
//     * Displays contact page.
//     *
//     * @return string
//     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Displays about page.
//     *
//     * @return string
//     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
//
//    public function actionTest() {
//        return $this->render('about');
//    }
//
//    private function checkMaster() {
//
//    }

}
