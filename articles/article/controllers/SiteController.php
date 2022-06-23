<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Tag;
use app\models\Authors;
use app\models\Articles;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;



class SiteController extends Controller
{
    /*
     * {@inheritdoc}
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
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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

      public function actionCreatetag()
    {
        $phpTag = new Tag();
        $phpTag->tag = 'testtest';
        //record table tag to bdd
        $phpTag->save();
        //recuperation de la valeur de la propriétée tag
        $tag = $phpTag->tag;

         return $this->render('createtag', ['tag'=>$tag]);
    }

     /**
     * Displays create author.
     *
     * @return string
     */
     public function actionCreateauthor()
    {
        $author = new Authors();
        $author->name = 'Arno Slatius';
        //reccord table to bdd
        $author->save();
        $authorValue = $author->name;
        
         return $this->render('author', ['name'=>$authorValue]);
    }

    /**
     * Displays create article.
     *
     * @return string
     */
     public function actionCreatearticle()
    {

        $author = new Authors();
        $articles = new Articles();
        $author->name = 'Arno Slatius';
        $author->save();
        //relation avec la table authors
        $articles->fk_author = $author->id_authors;

        //$author = new Authors();
        //$author->getArticles();
        
        //echo '<pre>' . print_r($articles, true) . '</pre>';die();
        $articles->title = 'Yii 2.0 ActiveRecord';
        $articles->description = 'Arno Slatius dives into the Yii ActiveRecord class';
        $articles->content = '... the article ...';
        $articles->lastEdited = new \yii\db\Expression('NOW()');
        //transfert des données dans la table articles
        $articles->save();

        /* Get all the articles for one author by using the author relation define in Articles */
        $dataProvider = new ArrayDataProvider([
            'allModels' => Authors::find()->all(),
            ]);

        echo '<pre>' . print_r($dataProvider, true) . '</pre>';die();
        
        //$title = $dataProvider->where->name;
        //$title = $articles->title;
        //$title = $author->id_authors;
        $title = $articles->id_article;

         //return $this->render('article', ['title'=>$title]);
         return $this->render('article', ['title'=>$dataProvider]);
    }

}
     


