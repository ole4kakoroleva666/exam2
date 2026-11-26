<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'course_name')->dropDownList([ 'oaip' => 'Oaip', 'owd' => 'Owd', 'opbd' => 'Opbd', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'payment_method')->dropDownList([ 'cash' => 'Cash', 'transaction' => 'Transaction', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'in_progress' => 'In progress', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
