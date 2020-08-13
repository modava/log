<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modava\log\LogModule;

/* @var $this yii\web\View */
/* @var $model modava\log\models\search\SystemLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'log_time') ?>

    <?= $form->field($model, 'prefix') ?>

    <?php // echo $form->field($model, 'message') ?>

    <div class="form-group">
        <?= Html::submitButton(LogModule::t('log', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(LogModule::t('log', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
