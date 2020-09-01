<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\log\LogModule;

/* @var $this yii\web\View */
/* @var $model modava\log\models\SystemLog */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="system-log-form">
    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'level')->textInput() ?>

		<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'log_time')->textInput() ?>

		<?= $form->field($model, 'prefix')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
