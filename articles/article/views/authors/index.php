<?php
namespace app\models;


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_authors',
            'name',
            'twiter',
            'linkedin',
            'gogglePlus',
            //'gitHub',
            //'about:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Authors $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_authors' => $model->id_authors]);
                 }
            ],
        ],
    ]); ?>


</div>
