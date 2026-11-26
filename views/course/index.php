<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Просмотр заявок на курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Записаться на новый курс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [
                'attribute' => 'course_name',
                'value' => static fn(Course $model) => $model->displayCourseName(),
            ],
            [
                'attribute' => 'start_date',
                'format' => ['date', 'php:m.d.Y'],
            ],
            [
                'attribute' => 'payment_method',
                'value' => static fn(Course $model) => $model->displayPaymentMethod(),
            ],
            [
                'attribute' => 'status',
                'value' => static fn(Course $model) => $model->displayStatus(),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Course $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
