<?php

namespace lo\modules\love\models;

use Yii;

/**
 * This is the model class for table "love__cat".
 *
 * @property integer $id
 * @property string $slug
 */
class Category extends \lo\core\db\TActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    const ROOT_APHORISM = 153;
    const ROOT_STORY = 154;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%love__cat}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return CategoryMeta::class;
    }

    /**
     * Возвращает ссылку на категорию
     * @return array|string
     */
    public function getRouteAphorism()
    {
        return '/love/aphorism/index';
    }
    
    /**
     * Возвращает ссылку на категорию
     * @return array|string
     */
    public function getRouteStory()
    {
        return '/love/story/index';
    }
}
