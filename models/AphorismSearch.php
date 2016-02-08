<?php

namespace lo\modules\love\models;

use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Expression;
use lo\modules\vote\models\AggregateRating;

/**
 * Class AphorismSearch
 * Модель для фильтрации афоризмов
 * @package lo\core\modules\love\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class AphorismSearch extends Aphorism
{
    public function attributeLabels()
    {
        return [
            'author' => 'Автор',
            'aggregate_rating' => 'Рейтинг'
        ];
    }

    /**
     * Возвращает провайдер данных
     * @return ActiveDataProvider
     */
    public function search($params, $ucp=false)
    {
        $query = $this->find();
        $query->modelClass = get_parent_class($this);

        $query->innerJoinWith([
            'aut' => function ($q) use ($params) {
                $q->andFilterWhere([Author::tableName() . '.slug' => $params['slug']]);
                $q->innerJoinWith([
                    'categories' => function ($q) use ($params) {
                        $q->andFilterWhere([Category::tableName() . '.slug' => $params['cat']]);
                        $q->published();
                    }
                ])->published();

            },
        ])->joinWith('aggregate');

        // user panel ?
        ($ucp) ? $query->innerJoinWith('faved') : $query->joinWith('faved');

        $query->groupBy(['id'])->published();

        $dataProvider = Yii::createObject([
            'class' => ActiveDataProvider::className(),
            "query" => $query,
        ]);

        $dataProvider->sort->attributes['author'] = [
            'asc' => [Author::tableName() . '.name' => SORT_ASC],
            'desc' => [Author::tableName() . '.name' => SORT_DESC],
            'label' => $this->getAttributeLabel('author'),
        ];

        $dataProvider->sort->attributes['aggregate_rating'] = [
            'asc' => [AggregateRating::tableName() . '.rating' => SORT_ASC],
            'desc' => [AggregateRating::tableName() . '.rating' => SORT_DESC],
            'label' => $this->getAttributeLabel('aggregate_rating'),
        ];

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        foreach ($this->metaFields->fields as $field) {
            $field->applySearch($query);
        }

/*        $dependency = new \yii\caching\DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM url'
        ]);

        \Yii::$app->db->cache(function() use ($dataProvider) {

            $dataProvider->prepare();

        }, \Yii::$app->params['cacheExpire'], $dependency);*/

        return $dataProvider;
    }
}
