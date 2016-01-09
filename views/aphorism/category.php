<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;

$this->title = Yii::t('frontend', 'Aphorismes');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['aphorism/index']];
$this->params['breadcrumbs'][] = $cat;

?>

<?php OffCanvas::begin();?>
<?= TreeList::widget([
    'modelClass' =>Category::className(),
    'urlCreate' => function($slug){
        return [Category::getRoute(), 'cat'=>$slug];
    },
    'parentId' => 153,
    'level'=>2,
    'options' =>[
        'class'=>'list-group sidebar-nav-v1',
        'id'=>'sidebar-nav'
    ]
]);
?>
<?php OffCanvas::end();?>


