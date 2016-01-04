<?php

namespace lo\modules\love\models;

use Yii;

class Parser extends \lo\core\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%love__aph}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return ParserMeta::className();
    }

    public function getAut()
    {
        return $this->hasOne(Author::className(), ['id' => 'aut_id']);
    }

}
