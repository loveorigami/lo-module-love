<?php

namespace lo\modules\love\modules\admin\controllers;

use Yii;
use lo\modules\love\models\Category;
use yii\web\Controller;
use lo\core\actions\crud;

/**
 * PageController implements the CRUD actions for Author model.
 */
class CategoryController extends Controller
{
    /**
     * Действия
     * @return array
     */

    public function actions()
    {
        $class = Category::className();
        return [
            'index' => [
                'class' => crud\TIndex::className(),
                'modelClass' => $class,
            ],

            'create' => [
                'class' => crud\TCreate::className(),
                'modelClass' => $class,
            ],

            'update' => [
                'class' => crud\TUpdate::className(),
                'modelClass' => $class,
            ],

            'view' => [
                'class' => crud\View::className(),
                'modelClass' => $class,
            ],

            'delete' => [
                'class' => crud\TDelete::className(),
                'modelClass' => $class,
            ],

            'groupdelete' => [
                'class' => crud\TGroupDelete::className(),
                'modelClass' => $class,
            ],

            'up' => [
                'class' => crud\TUp::className(),
                'modelClass' => $class,
            ],

            'down' => [
                'class' => crud\TDown::className(),
                'modelClass' => $class,
            ],

            'replace' => [
                'class' => crud\TReplace::className(),
                'modelClass' => $class,
            ],

            'editable'=>[
                'class'=>crud\XEditable::className(),
                'modelClass'=>$class,
            ],

            'list'=>[
                'class'=>crud\ListId::className(),
                'modelClass'=>$class,
            ],
        ];
    }

}
