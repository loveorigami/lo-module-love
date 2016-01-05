<?php
namespace lo\modules\love\models;

use Yii;
use lo\core\db\MetaFields;


/**
 * Class PageMeta
 * Мета описание модели страницы
 * @package app\modules\banners\models\meta
 */
class AuthorMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    const SEO_TAB = "seo";

    /**
     * @inheritdoc
     */

    public function tabs()
    {
        $tabs = parent::tabs();
        $tabs[self::SEO_TAB] = Yii::t('backend', "SEO");
        return $tabs;
    }

    /**
     * Возвращает категории для dropDown
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getCategoriesList()
    {
        $model = \Yii::createObject(Category::className());
        return $model->getDataByParent();
    }

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
                            'path'=>'love/author'
                        ],
                    ],
                    "title" => Yii::t('common', 'Image'),
                ],
                "params" => [$this->owner, "img"]
            ],
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
            "fullname" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'Fullname'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "fullname"]
            ],
            "date" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'Date'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "date"]
            ],
            "link" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'Link'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "link"]
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

            "categories" => [
                "definition" => [
                    "class" => \lo\core\db\fields\ManyManyField::className(),
                    "title" => Yii::t('backend', 'Categories'),
                    "isRequired" => true,
                    "data" => [$this, "getCategoriesList"],
                ],
                "params" => [$this->owner, "categoriesIds", "categories"]
            ],


            "in_aph" => [
                "definition" => [
                    "class" => \lo\core\db\fields\CheckBoxField::className(),
                    "title" => Yii::t('common', 'InAph'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "in_aph"]
            ],
            "in_story" => [
                "definition" => [
                    "class" => \lo\core\db\fields\CheckBoxField::className(),
                    "title" => Yii::t('common', 'InStory'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "in_story"]
            ],
            "in_let" => [
                "definition" => [
                    "class" => \lo\core\db\fields\CheckBoxField::className(),
                    "title" => Yii::t('common', 'InLet'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "in_let"]
            ],
            "in_poem" => [
                "definition" => [
                    "class" => \lo\core\db\fields\CheckBoxField::className(),
                    "title" => Yii::t('common', 'InPoem'),
                    "showInGrid" => false,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "in_poem"]
            ],

            "text" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HtmlField::className(),
                    "inputClass" =>[
                        'class'=>'lo\core\inputs\HtmlInput',
                        "fileManagerController"=>['elfinder', 'path' => 'love/author'],
                    ],
                    "inputClassOptions" => [
                        "widgetOptions"=>[
                            'editorOptions'=>[
                                //'preset' => 'basic',
                            ]
                        ],
                    ],
                    "title" => Yii::t('common', 'Text'),
                    "showInGrid" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "text"]
            ],
            "intro" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextAreaField::className(),
                    "title" => Yii::t('common', 'Intro'),
                    "showInGrid" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "intro"]
            ],



            "title" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'title'),
                    "showInGrid" => false,
                    "isRequired" => false,
                    "tab" => self::SEO_TAB,
                ],
                "params" => [$this->owner, "title"]
            ],
            "description" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextAreaField::className(),
                    "title" => Yii::t('common', 'description'),
                    "showInGrid" => false,
                    "isRequired" => false,
                    "tab" => self::SEO_TAB,
                ],
                "params" => [$this->owner, "description"]
            ],
            "keywords" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'keywords'),
                    "showInGrid" => false,
                    "isRequired" => false,
                    "tab" => self::SEO_TAB,
                ],
                "params" => [$this->owner, "keywords"]
            ],
        ];
    }
}