<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id_tag
 * @property string|null $tag
 *
 * @property Articletag[] $articletags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tag' => 'Id Tag',
            'tag' => 'Tag',
        ];
    }

    /**
     * Gets query for [[Articletags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticletags()
    {
        return $this->hasMany(Articletag::className(), ['fk_tag' => 'id_tag']);
    }
}
