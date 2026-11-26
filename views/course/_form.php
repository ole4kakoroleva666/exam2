<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_name')->dropDownList([
        'oaip' => 'Основы алгоритмизации и программирования',
        'owd' => 'Основы веб-дизайна',
        'opbd' => 'Основы проектирования баз данных',
        ],
        ['prompt' => 'Выберите курс']) ?>

    <?= $form->field($model, 'start_date')->textInput(
        ['type' => 'date',
        ]) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([
        'cash' => 'Наличными',
        'transaction' => 'Перевод по номеру телефона',
        ],
        ['prompt' => 'Выберите способ оплаты']) ?>

    <div class="form-group">
        <?= Html::submitButton('Записаться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
