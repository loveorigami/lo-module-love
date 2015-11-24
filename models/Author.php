<?php

namespace lo\modules\love\models;

use Yii;
use lo\modules\import\models\ICsvImportable;


/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string $view
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Author extends \lo\core\db\ActiveRecord implements ICsvImportable
{

    use \lo\core\rbac\ConstraintTrait;

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%love__author}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return AuthorMeta::className();
    }

    /**
     * Возвращает массив атрибутов доступных для импорта из csv
     * @return array
     */
    public function getCsvAttributes()
    {
        $attrs = array_keys($this->getAttributes( null, ['updated_at', 'updater_id'])); // пропустить
       // $attrs[] = "id";
        //$attrs[] = "confirm_password";
        return $attrs;

    }

    public function getCsvCallbacks(){
        return  [
            'status' => 'cbStatus',
            'image' => 'cbImage'
        ];
    }

    public function cbStatus($val){
        return $val==1 ? 0 : 1;
    }

    public function cbImage($val){
        return '/love/author/'.$val;
    }
}
