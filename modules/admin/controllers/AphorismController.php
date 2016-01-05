<?php

namespace lo\modules\love\modules\admin\controllers;

use Yii;
use lo\modules\love\models\Aphorism;
use yii\web\Controller;
use lo\core\actions\crud;

/**
 * PageController implements the CRUD actions for Author model.
 */
class AphorismController extends Controller
{
    /**
     * Действия
     * @return array
     */

    public function actions()
    {
        $class = Aphorism::className();
        return [
            'index'=>[
                'class'=> crud\Index::className(),
                'modelClass'=>$class,
            ],
            'view'=>[
                'class'=> crud\View::className(),
                'modelClass'=>$class,
            ],
            'create'=>[
                'class'=> crud\Create::className(),
                'modelClass'=>$class,
            ],
            'update'=>[
                'class'=> crud\Update::className(),
                'modelClass'=>$class,
            ],
            'delete'=>[
                'class'=> crud\Delete::className(),
                'modelClass'=>$class,
            ],
            'groupdelete'=>[
                'class'=>crud\GroupDelete::className(),
                'modelClass'=>$class,
            ],

            'editable'=>[
                'class'=>crud\XEditable::className(),
                'modelClass'=>$class,
            ],
        ];
    }

}