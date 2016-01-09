<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $model->name;
$breadcrumbs = $model->getBreadCrumbsItems($model->id, function ($m) {
    return ["/" . Yii::$app->controller->route, "cat" => $m->slug];
});
$breadcrumbs = array_slice($breadcrumbs, 0, -1);
$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['breadcrumbs'][0] = ['label' => Yii::t('frontend', 'Aphorismes'), 'url' => ['aphorism/index']];;
$this->params['breadcrumbs'][] = $model->name;

?>

<?php OffCanvas::begin(); ?>
<?= TreeList::widget([
    'modelClass' => Category::className(),
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
<?php OffCanvas::end(); ?>


<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="tag-box tag-box-v3">
        <div class="heading heading-v4">
            <h2><?=$model->name?></h2>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it.</p>
        </div>

        <hr class="devider devider-dotted">


            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
            ]); ?>


    </div>
</div>
