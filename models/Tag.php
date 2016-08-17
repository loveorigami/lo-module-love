<?php

namespace lo\modules\love\models;

use Yii;


/**
 * This is the model class.
 *
 * @property integer $id
 */
class Tag extends \lo\core\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%love__tag}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return TagMeta::class;
    }

}
