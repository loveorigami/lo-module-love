<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;

$this->title = $model->name;

$breadcrumbs = $model->getBreadCrumbsItems($model->id, function ($m) {
    return ["/" . Yii::$app->controller->route, "cat" => $m->slug];
});
    $breadcrumbs = array_slice($breadcrumbs, 0, -1);
    $this->params['breadcrumbs'] = $breadcrumbs;
    $this->params['breadcrumbs'][0] = ['label' => Yii::t('frontend', 'Aphorismes'), 'url' => ['aphorism/index']];;
    $this->params['breadcrumbs'][] = $model->name;

?>

просмотров: <?=$model->total_hits ?>

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
    ],
]);
?>
<?php OffCanvas::end();?>


