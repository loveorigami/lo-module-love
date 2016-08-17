<?php

namespace lo\modules\love\models;

use Yii;
use lo\modules\import\models\ICsvImportable;


/**
 * This is the model class.
 *
 * @property integer $id
 */
class Prim extends \lo\core\db\ActiveRecord implements ICsvImportable
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%love__aph_prim}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return PrimMeta::class;
    }

    /**
     * Возвращает массив атрибутов доступных для импорта из csv
     * @return array
     */
    public function getCsvAttributes()
    {
        $attrs = array_keys($this->getAttributes( null, ['updated_at', 'updater_id', 'author_id', 'created_at'])); // пропустить
       // $attrs[] = "id";
        //$attrs[] = "confirm_password";
        return $attrs;
    }

    public function getCsvCallbacks(){
        return  [];
    }

}
