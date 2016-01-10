<?php

use yii\widgets\ListView;

?>


<?= ListView::widget([
    'layout' => "{sorter}\n{summary}\n{items}\n{pager}", // Add sorter to layout because it's turned off by default
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'sorter'=>[
        'attributes'=>['id', 'author']
    ],
]); ?>


