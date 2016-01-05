<?php
namespace lo\modules\love\models;

use Yii;
use lo\core\db\MetaFields;


/**
 * Class Meta
 * Мета описание модели
 */
class CategoryMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "img" => [
                "definition" => [
                    "class" => \lo\core\db\fields\ElfImgField::className(),
                    "inputClassOptions" => [
                        "widgetOptions"=>[
                            'path'=>'love/lib'
                        ],
                    ],
                    "initValue"=>"/love/cat/none.jpg",
                    "title" => Yii::t('backend', 'Image'),
                ],
                "params" => [$this->owner, "img"]
            ],
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
            "slug" => [
                "definition" => [
                    "class" => \lo\core\db\fields\SlugField::className(),
                    "title" => Yii::t('common', 'Slug'),
                    "showInGrid" => true,
                    "generateFrom" => "name",
                ],
                "params" => [$this->owner, "slug"]
            ],

            "intro" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextAreaField::className(),
                    "title" => Yii::t('backend', 'Intro'),
                    "showInGrid" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "intro"]
            ],
        ];
    }
}