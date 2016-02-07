<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;
?>

<?php
Pjax::begin([
    'timeout'=>70000,
    //'enablePushState'=>false
    //'id'=>'items-content'
]);

echo ListView::widget([
    'layout' => "{summary}\n{sorter}\n<div class='clearfix'></div>{items}\n{pager}", // Add sorter to layout because it's turned off by default
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'sorter'=>[
        'attributes'=>['aggregate_rating', 'id', 'author']
    ],
]);

Pjax::end();


