<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\block\Block;
use lo\core\widgets\search\Search;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = $model->name;

$breadcrumbs = $model->getBreadCrumbsItems($model->id, function ($m) {
    return ["/" . Yii::$app->controller->route, "cat" => $m->slug];
});
$breadcrumbs = array_slice($breadcrumbs, 0, -1);
$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['breadcrumbs'][0] = ['label' => Yii::t('frontend', 'Aphorismes'), 'url' => ['aphorism/index']];;
$this->params['breadcrumbs'][] = $model->name;

$action = $model->id == Category::ROOT_APHORISM ? ['index'] : ['index', 'cat'=>$model->slug];

?>

<?php OffCanvas::begin(); ?>

<?= Search::widget([
    'searchModel' => $searchModel,
    'action' => $action,
    'title' => 'Поиск афоризмов' ,
]);
//var_dump($searchModel);
?>

<?php Block::begin(['title'=>'Категории']); ?>

    <?= TreeList::widget([
        'modelClass' => Category::class,
        'urlCreate' => function ($slug) {
            return [Category::getRoute(), 'cat'=>$slug];
        },
        'parentId' => Category::ROOT_APHORISM,
        'level' => 2,
        'options' => [
            'class' => 'list-group sidebar-nav-v1',
            'id' => 'sidebar-nav'
        ]
    ]);
    ?>
<?php Block::end(); ?>
<?php OffCanvas::end(); ?>


<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <?php Block::begin(['title'=>$model->name, 'type'=>'green']); ?>
    <div class="heading heading-v4">
        <h1><?=$model->name?></h1>
        <p><?=$model->intro?></p>
    </div>
    <?php Block::end(); ?>

    <?=$res['html']?>

</div>
