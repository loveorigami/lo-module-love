<?php

namespace lo\modules\love\models;

use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Expression;

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
    public function search($params)
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
        ])->groupBy(['id'])->published();

        $dataProvider = Yii::createObject([
            'class' => ActiveDataProvider::className(),
            "query" => $query,
        ]);

        $dataProvider->sort->attributes['author'] = [
            'asc' => [Author::tableName() . '.name' => SORT_ASC],
            'desc' => [Author::tableName() . '.name' => SORT_DESC],
            'label' => $this->getAttributeLabel('author'),
        ];

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        foreach ($this->metaFields->fields as $field) {
            $field->applySearch($query);
        }

        return $dataProvider;
    }
}
