<?php
/**
 * Created by PhpStorm.
 * User: loveorigami
 * Date: 8/1/16
 * Time: 2:01 PM
 */

namespace lo\modules\love\controllers;

use lo\modules\love\models\Aphorism;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class AphorismController extends Controller
{
    public function actionIndex(){

        return $this->render('index');
    }

    public function actionView($slug){
        $model = Author::find()->where(['slug'=>$slug])->published()->one();
        if(!$model){
            throw new NotFoundHttpException(\Yii::t('frontend', 'Page not found'));
        }
        return $this->render('view', ['model'=>$model]);
    }

    public function actionCategory($cat){
        return $this->render('category', compact('cat'));
    }
} 