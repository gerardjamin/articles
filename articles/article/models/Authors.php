<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id_authors
 * @property string|null $name
 * @property string|null $twiter
 * @property string|null $linkedin
 * @property string|null $gogglePlus
 * @property string|null $gitHub
 * @property string|null $about
 *
 * @property Articles[] $articles
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['twiter'], 'string', 'max' => 45],
            [['linkedin', 'gogglePlus', 'gitHub'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_authors' => 'Id Authors',
            'name' => 'Name',
            'twiter' => 'Twiter',
            'linkedin' => 'Linkedin',
            'gogglePlus' => 'Goggle Plus',
            'gitHub' => 'Git Hub',
            'about' => 'About',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['fk_author' => 'id_authors']);
    }
}
