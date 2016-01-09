<?php
/**
 * Created by PhpStorm.
 * User: loveorigami
 * Date: 8/1/16
 * Time: 2:01 PM
 */

namespace lo\modules\love\controllers;

use lo\modules\love\models\Aphorism;
use lo\modules\love\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;



class AphorismController extends Controller
{
    public function actionIndex($cat=''){

        if($cat){
            $model = Category::find()->bySlug($cat)->one();
        }
        else{
            $model = Category::findOne(['id'=>Category::ROOT_APHORISM]);
        }

        $model->updateCounters(['total_hits' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => Aphorism::find()->published(),
        ]);

        return $this->render('index', compact('model', 'dataProvider'));

    }

    public function actionView($slug){
        $model = Author::find()->where(['slug'=>$slug])->published()->one();
        if(!$model){
            throw new NotFoundHttpException(\Yii::t('frontend', 'Page not found'));
        }
        return $this->render('view', ['model'=>$model]);
    }

    public function actionCategory($cat){

        $model = Category::find()->bySlug($cat)->one();
        $model->updateCounters(['total_hits' => 1]);


        return $this->render('category',compact('model'));
    }

} 