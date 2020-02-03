<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class GenerosSearch extends Generos
{
    public function search($params)
    {
        $query = Generos::find()
            ->select(['generos.*', 'COUNT(l.id) AS total'])
            ->joinWith('libros l')
            ->groupBy('generos.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'denom' => [
                        'label' => 'Denominación',
                    ],
                ],
            ],
        ]);

        $this->load($params);
     
        if (!$this->validate()) {
            $query->where('1 = 0');
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'denom', $this->denom]);

        return $dataProvider;
    }
    
    public $total;

    public function rules()
    {
        return [
            [['denom'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
            [['genero.denom'], 'safe'],
            [['total'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['total']);
    }
}
