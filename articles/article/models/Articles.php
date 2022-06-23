<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id_article
 * @property string|null $lastEdited
 * @property string|null $published
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property int $fk_author
 *
 * @property Articletag[] $articletags
 * @property Authors $fkAuthor
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastEdited', 'published'], 'safe'],
            [['description', 'content'], 'string'],
            [['fk_author'], 'required'],
            [['fk_author'], 'integer'],
            [['title'], 'string', 'max' => 25],
            [['fk_author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['fk_author' => 'id_authors']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_article' => 'Id Article',
            'lastEdited' => 'Last Edited',
            'published' => 'Published',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'fk_author' => 'Fk Author',
        ];
    }

    /**
     * Gets query for [[Articletags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticletags()
    {
        return $this->hasMany(Articletag::className(), ['fk_article' => 'id_article']);
    }

    /**
     * Gets query for [[FkAuthor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkAuthor()
    {
        return $this->hasOne(Authors::className(), ['id_authors' => 'fk_author']);
    }
}
