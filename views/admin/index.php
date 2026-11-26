<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки на курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'ФИО',
                'value' => static fn ($model) =>
                $model->user->FIO,

            ],
            [
                'attribute' => 'course_name',
                'value' => function($model){
                    return $model->displayCourseName();
                },
            ],
            [
                'attribute' => 'start_date',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'payment_method',
                'value' => function($model){
                    return $model->displayPaymentMethod();
                }
            ],
            [
                'label' => 'Изменить статус',
                'format' => 'raw',
                'value' => function ($model) {
                    $isCompleted = $model->status === 'completed';
                    return Html::beginForm(['update-status'], 'post', ['class' => 'd-flex gap-2']) .
                        Html::hiddenInput('id', $model->id) .
                        Html::dropDownList('status', $model->status, app\models\Course::optsStatus(), [
                            'class' => 'form-select form-select-sm',
                            'style' => 'max-width: 220px;',
                        ]) .
                        Html::submitButton('Сохранить', ['class' => 'btn btn-sm btn-primary']) .
                        Html::endForm();
                },
            ],
        ],
    ]); ?>


</div>
