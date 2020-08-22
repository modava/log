<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use modava\log\models\search\Voip24hLogSearch;

/* @var $model Voip24hLogSearch */
?>
<?php $form = ActiveForm::begin([
    'method' => 'GET'
]) ?>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <?= $form->field($model, 'from')->widget(DatePicker::class, [
                'addon' => '<button type="button" class="btn btn-increment btn-light"><i class="ion ion-md-calendar"></i></button>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'endDate' => '+0d',
                    'orientation' => "bottom"
                ]
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <?= $form->field($model, 'to')->widget(DatePicker::class, [
                'addon' => '<button type="button" class="btn btn-increment btn-light"><i class="ion ion-md-calendar"></i></button>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'endDate' => '+0d',
                    'orientation' => "bottom"
                ]
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <?= $form->field($model, 'search')->textInput([
                'placeholder' => $model->getAttributeLabel('search')
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <?= $form->field($model, 'status')->dropDownList(Voip24hLogSearch::STATUS, [
                'prompt' => $model->getAttributeLabel('status')
            ]) ?>
        </div>
        <div class="d-none">
            <?= $form->field($model, 'start')->textInput([
                'id' => 'voip24h-log-start',
                'value' => ''
            ]) ?>
        </div>
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton('Seach', [
            'class' => 'btn btn-primary',
            'id' => 'search-log'
        ]) ?>
    </div>
<?php ActiveForm::end() ?>