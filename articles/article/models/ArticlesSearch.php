<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articles;

/**
 * ArticlesSearch represents the model behind the search form of `app\models\Articles`.
 */
class ArticlesSearch extends Articles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_article', 'fk_author'], 'integer'],
            [['lastEdited', 'published', 'title', 'description', 'content'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Articles::find();

        //debug
        
        $debug = Articles::find();

        echo '<pre>' . print_r($debug, true) . '</pre>'; die();
        
        //debug


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //debug
        
        //echo '<pre>' . print_r($dataProvider, true) . '</pre>'; die();

        //debug


        //debug
        
        //echo '<pre>' . print_r($params, true) . '</pre>'; die();

        //debug

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');




             //debug
        
               // echo '<pre>' . print_r($dataProvider, true) . '</pre>'; die();

             //debug


            return $dataProvider;
        }

            //debug
        
                //echo '<pre>' . print_r($query, true) . '</pre>'; die();
                //echo '<pre>' . print_r($this, true) . '</pre>'; die();
             //debug 



        // grid filtering conditions
        $query->andFilterWhere([
            'id_article' => $this->id_article,
            'lastEdited' => $this->lastEdited,
            'published' => $this->published,
            'fk_author' => $this->fk_author,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);

          //debug
            
           //echo '<pre>' . print_r($dataProvider, true) . '</pre>'; die(); 
           //echo '<pre>' . print_r($query->select, true) . '</pre>'; die();

             //debug  

        return $dataProvider;
    }
}
