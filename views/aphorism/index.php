<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

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



<?php $form = ActiveForm::begin([
    'action' => $action,
    'method' => 'get',
]);

echo Html::activeTextInput($searchModel,
    'text',
    ['placeholder' => 'Поиск...']
); ?>

<button class="button-search pull-right" type="submit">
    <span class="fa fa-search"></span>
</button>
<?php $form->end(); ?>

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
            <p><?=$model->intro?></p>
        </div>

        <hr class="devider devider-dotted">

            <?=$res['html']?>

    </div>
</div>
