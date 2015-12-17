<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/book-index.js',['depends' => [\yii\web\JqueryAsset::className()]]); 

?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
            ],
            [
                'attribute' => 'name',
                'filter' => false,
            ],
            [
                    'attribute' => 'image',
                    'format' => 'raw',    
                    'value' => function ($data) {
                        return Html::a(Html::img(Yii::getAlias('@web').'/uploads/'. $data['preview'],['width' => '70px']),
                                Yii::getAlias('@web').'/uploads/'. $data['preview'],
                                ['rel' => 'fancybox']);
                    },
            ],
            [
                    'attribute' => 'author_id',
                    'format' => 'html',    
                    'value' => function ($data) {
                        return $data->getAuthorName();
                    },
                    'filter' => false,
            ],
            [
                    'attribute' => 'date_release',
                    'format' => 'html',    
                    'value' => function ($data) {
                        return \Yii::$app->formatter->asDate($data->date_create);
                    },
                    'filter' => false,
            ],
            [
                'attribute' => 'date_create',
                'format' => 'html',    
                'value' => function ($data) {
                    return \Yii::$app->formatter->asDate($data->date_create);
                },
                'filter' => false,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['width' => '20%', 'class' => 'activity-view-link',],        
                    'contentOptions' => ['class' => 'padding-left-5px'],

                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                            'class' => 'activity-view-link',
                            'title' => Yii::t('yii', 'View'),
                            'data-toggle' => 'modal',
                            'data-target' => '#activity-modal',
                            'data-id' => $key,
                            'data-pjax' => '0',

                        ]);
                    },
                ],


            ],
        ],
    ]); ?>
 <?php echo newerton\fancybox\FancyBox::widget([
            'target' => 'a[rel=fancybox]',
            'helpers' => true,
            'mouse' => true,
            'config' => [
                'maxWidth' => '90%',
                'maxHeight' => '90%',
                'playSpeed' => 7000,
                'padding' => 0,
                'fitToView' => false,
                'width' => '70%',
                'height' => '70%',
                'autoSize' => false,
                'closeClick' => false,
                'openEffect' => 'elastic',
                'closeEffect' => 'elastic',
                'prevEffect' => 'elastic',
                'nextEffect' => 'elastic',
                'closeBtn' => false,
                'openOpacity' => true,
                'helpers' => [
                    'title' => ['type' => 'float'],
                    'buttons' => [],
                    'thumbs' => ['width' => 68, 'height' => 50],
                    'overlay' => [
                        'css' => [
                            'background' => 'rgba(0, 0, 0, 0.8)'
                        ]
                    ]
                ],
            ]
        ]);

?>

<?php Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">View Image</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',

]); ?>

<div class="well">
</div>

<?php Modal::end(); ?>
</div>
