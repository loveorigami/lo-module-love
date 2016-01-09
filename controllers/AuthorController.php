<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace lo\modules\love\controllers;

use lo\modules\love\models\Author;
use yii\web\Controller;
use sjaakp\alphapager\ActiveDataProvider;
use yii\web\NotFoundHttpException;


class AuthorController extends Controller
{

    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => Author::find()->orderBy('name'),
            'alphaAttribute' => 'name',
            'alphaDigits' => ['А', 'Б']
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionView($slug){
        $model = Author::find()->where(['slug'=>$slug])->published()->one();
        if(!$model){
            throw new NotFoundHttpException(\Yii::t('frontend', 'Page not found'));
        }
        return $this->render('view', ['model'=>$model]);
    }
} 