<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>


<div class="testimonials testimonials-v1">
    <div class="item">
        <p><?= $model->text ?></p>

        <div class="testimonial-info">
            <?= Html::img('@storageUrl' . $model->aut->img, ['class' => 'rounded-x', 'alt' => $model->aut->name]); ?>
            <span class="testimonial-author">
                            <?= Html::a($model->aut->name, Url::to(['author/view', 'slug' => $model->aut->slug])) ?>
                <em>
                    <a title="в избранное" id="fav_6186_0" class="btn btn-primary btn-xs" href="#"> <i
                            class="fa fa-heart"> 45</i></a>
                    <a title="в избранное" id="fav_6186_0" class="btn btn-success btn-xs" href="#"> <i
                            class="fa fa-thumbs-up"> 25</i></a>
                    <a title="в избранное" id="fav_6186_0" class="btn btn-danger btn-xs" href="#"> <i
                            class="fa fa-thumbs-down"> 25</i></a>
                </em>
                        </span>
        </div>
    </div>
</div>

<hr class="devider devider-dotted">



