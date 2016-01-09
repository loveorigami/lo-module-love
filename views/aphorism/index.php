<?php
use lo\core\widgets\offcanvas\OffCanvas;
use lo\core\widgets\treelist\TreeList;
use lo\modules\love\models\Category;
use yii\helpers\Url;

$this->title = Yii::t('frontend', 'Aphorismes');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php OffCanvas::begin();?>
<?= TreeList::widget([
    'modelClass' =>Category::className(),
    'urlCreate' => function($slug){
        return Url::to([Category::getRoute(), 'cat'=>$slug]);
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


<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="tag-box tag-box-v3">
        <div class="heading heading-v4">
            <h2>3 Single Line Deviders</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.</p>
        </div>

        <hr class="devider devider-dotted">
<div class="row">

            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <h2>Expedita distinctio lorem ipsum!</h2>
                    <p>Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.</p>
                </div>
            </div>
</div>

    </div>
</div>
