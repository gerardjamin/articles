<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articletag".
 *
 * @property int $id_articleTag
 * @property int $fk_article
 * @property int $fk_tag
 *
 * @property Articles $fkArticle
 * @property Tag $fkTag
 */
class Articletag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articletag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_article', 'fk_tag'], 'required'],
            [['fk_article', 'fk_tag'], 'integer'],
            [['fk_article'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['fk_article' => 'id_article']],
            [['fk_tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['fk_tag' => 'id_tag']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_articleTag' => 'Id Article Tag',
            'fk_article' => 'Fk Article',
            'fk_tag' => 'Fk Tag',
        ];
    }

    /**
     * Gets query for [[FkArticle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkArticle()
    {
        return $this->hasOne(Articles::className(), ['id_article' => 'fk_article']);
    }

    /**
     * Gets query for [[FkTag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTag()
    {
        return $this->hasOne(Tag::className(), ['id_tag' => 'fk_tag']);
    }
}
