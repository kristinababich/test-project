<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'author_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'last_name'))->label(false) ?>
   
    <?= $form->field($model, 'name')->textInput(['placeholder' => 'название книги'])->label(false) ?>

    <?= $form->field($model,'from_date')->widget(DatePicker::className(),[])->label('дата выхода книги :') ?>
    
    <?= $form->field($model,'to_date')->widget(DatePicker::className(),[])->label('до :') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
