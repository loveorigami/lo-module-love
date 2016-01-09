<?php

namespace lo\modules\love\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $text
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Aphorism extends \lo\core\db\ActiveRecord
{

    use \lo\core\rbac\ConstraintTrait;

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    public $tplDir = '@lo/modules/love/modules/admin/views/aphorism/tpl/';
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
        return AphorismMeta::className();
    }

    public function getLib()
    {
        return $this->hasOne(Lib::className(), ['id' => 'lib_id']);
    }

    public function getAut()
    {
        return $this->hasOne(Author::className(), ['id' => 'aut_id']);
    }

    public function getPrim()
    {
        return $this->hasOne(Prim::className(), ['id' => 'prim_id']);
    }



}
