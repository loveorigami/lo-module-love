<?php

use yii\widgets\ListView;

?>


<?= ListView::widget([
    'layout' => "{summary}\n{sorter}\n<div class='clearfix'></div>{items}\n{pager}", // Add sorter to layout because it's turned off by default
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'sorter'=>[
        'attributes'=>['aggregate_rating', 'id', 'author']
    ],
]); ?>


